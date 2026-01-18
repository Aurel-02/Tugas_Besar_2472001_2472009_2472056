<?php
session_start();

if (!isset($_SESSION['login']) || $_SESSION['role_id'] !== '2') {
    header("Location: /login.php");
    exit;
}

include __DIR__ . '/../koneksi.php';

$nip = $_SESSION['user_id'];

$qSemester = $conn->prepare("
    SELECT MAX(semester) AS semester
    FROM tbperwalian
    WHERE nip = ?
");
$qSemester->bind_param("s", $nip);
$qSemester->execute();

$dataSemester = $qSemester->get_result()->fetch_assoc();
$semesterMax = ($dataSemester && $dataSemester['semester']) ? (int)$dataSemester['semester'] : 1;

$semester = isset($_GET['semester']) ? (int)$_GET['semester'] : $semesterMax;
if ($semester < 1 || $semester > $semesterMax) {
    $semester = $semesterMax;
}

$query = "
    SELECT 
        hari,
        jam_mulai,
        jam_selesai,
        kelas,
        ruang,
        semester,
        sks,
        id_mk,
        nama_mk
    FROM tbperwalian
    WHERE nip = ?
      AND semester = ?
    ORDER BY 
        CASE hari
            WHEN 'Senin' THEN 1
            WHEN 'Selasa' THEN 2
            WHEN 'Rabu' THEN 3
            WHEN 'Kamis' THEN 4
            WHEN 'Jumat' THEN 5
            ELSE 6
        END,
        jam_mulai
";

$stmt = $conn->prepare($query);
$stmt->bind_param("si", $nip, $semester);
$stmt->execute();

$result = $stmt->get_result();

$jadwalPerHari = [];
while ($row = $result->fetch_assoc()) {
    $jadwalPerHari[$row['hari']][] = $row;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Jadwal Perkuliahan Dosen</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="../css/sidebar.css">
    <link rel="stylesheet" href="../css/jadwal_perkuliahan.css">
</head>
<body>

<div class="layout">

    <?php include __DIR__ . '/include/sidebar.php'; ?>

    <div class="main-content">

        <div class="jadwal-header px-4">
            <div class="row align-items-center h-100">
                <div class="col">
                    <h3 class="mb-0 text-white">Jadwal Perkuliahan Dosen</h3>
                </div>
                <div class="col-auto">
                    <form method="GET">
                        <select 
                            name="semester"
                            class="form-select form-select-sm"
                            onchange="this.form.submit()"
                        >
                            <?php for ($i = 1; $i <= $semesterMax; $i++): ?>
                                <option value="<?= $i ?>" <?= ($semester == $i) ? 'selected' : '' ?>>
                                    Semester <?= $i ?>
                                </option>
                            <?php endfor; ?>
                        </select>
                    </form>
                </div>
            </div>
        </div>

        <div class="container mt-4 pt-3">
            <div class="row g-4">

            <?php if (!empty($jadwalPerHari)): ?>
                <?php foreach ($jadwalPerHari as $hari => $list): ?>

                <div class="col-12">
                    <div class="card jadwal-card h-100">
                        <div class="card-header fw-bold">
                            <?= strtoupper($hari) ?>
                        </div>

                        <div class="card-body">
                            <?php foreach ($list as $row): ?>
                                <div class="jadwal-detail mb-3">
                                    <div class="fw-bold">
                                        <?= $row['id_mk'] ?> - <?= $row['nama_mk'] ?>
                                    </div>
                                    <div><?= $row['sks'] ?> SKS</div>
                                    <div>Kelas <?= $row['kelas'] ?></div>
                                    <div>Ruang <?= $row['ruang'] ?></div>
                                    <div>
                                        Waktu 
                                        <?= substr($row['jam_mulai'], 0, 5) ?> -
                                        <?= substr($row['jam_selesai'], 0, 5) ?>
                                    </div>
                                </div>
                                <hr>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>

                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12 text-center text-muted">
                    Tidak ada jadwal mengajar
                </div>
            <?php endif; ?>

            </div>
        </div>

    </div>
</div>

</body>
</html>
