<?php
session_start();
if (!isset($_SESSION['login']) || $_SESSION['role_id'] !== '3') {
    header("Location: /login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Jadwal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/sidebar.css">
    <link rel="stylesheet" href="../css/jadwal_perkuliahan.css">
</head>
<body>
<?php
include __DIR__ . '/../koneksi.php';

$nrp = $_SESSION['user_id'];

$qSemester = $conn->prepare("
    SELECT MAX(p.semester) AS semester
    FROM tbdkbs d
    JOIN tbperwalian p ON d.id_perwalian = p.id_perwalian
    WHERE d.nrp = ?
");

if (!$qSemester) {
    die("Prepare semester gagal: " . $conn->error);
}

$qSemester->bind_param("s", $nrp);
$qSemester->execute();

$dataSemester = $qSemester->get_result()->fetch_assoc();
$semesterMax = $dataSemester ? (int)$dataSemester['semester'] : 1;

if (isset($_GET['semester']) && $_GET['semester'] !== '') {
    $semester = (int) $_GET['semester'];

    if ($semester < 1 || $semester > $semesterMax) {
        $semester = $semesterMax;
    }
} else {
    $semester = $semesterMax; 
}

$query = "
    SELECT 
        p.hari,
        p.jam_mulai,
        p.jam_selesai,
        p.kelas,
        p.ruang,
        p.semester,
        p.sks,
        p.id_mk,
        p.nama_mk
    FROM tbdkbs d
    JOIN tbperwalian p ON d.id_perwalian = p.id_perwalian
    WHERE d.nrp = ?
      AND p.semester = ?
    ORDER BY 
        CASE p.hari
            WHEN 'Senin' THEN 1
            WHEN 'Selasa' THEN 2
            WHEN 'Rabu' THEN 3
            WHEN 'Kamis' THEN 4
            WHEN 'Jumat' THEN 5
            ELSE 6
        END,
        p.jam_mulai
";

$stmt = $conn->prepare($query);
if (!$stmt) {
    die("Prepare jadwal gagal: " . $conn->error);
}

$stmt->bind_param("si", $nrp, $semester);
$stmt->execute();

$result = $stmt->get_result();

$jadwalPerHari = [];

while ($row = $result->fetch_assoc()) {
    $jadwalPerHari[$row['hari']][] = $row;
}
?>


<div class="layout">

    <?php include __DIR__ . '/include/sidebar.php'; ?>

    <div class="main-content">
        <div class="jadwal-header px-4">
            <div class="row align-items-center h-100">
                <div class="col">
                    <h3 class="mb-0 text-white">Jadwal Perkuliahan</h3>
                </div>
                <div class="col-auto">
                    <select class="form-select form-select-sm">
                        <option value="1">Perkuliahan</option>
                        <option value="2">UTS</option>
                        <option value="3">UAS</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="container mt-4 pt-3">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <form method="GET" class="d-inline">
                        <label class="me-2">Semester Perkuliahan</label>
                        <select 
                            name="semester"
                            class="form-select form-select-sm d-inline-block w-auto"
                            onchange="this.form.submit()"
                        >
                            <?php for ($i = 1; $i <= $semesterMax; $i++): ?>
                                <option value="<?= $i ?>" <?= ($semester == $i) ? 'selected' : '' ?>>
                                    <?= $i ?>
                                </option>
                            <?php endfor; ?>
                        </select>
                    </form>
                </div>
            </div>

            <div class="row g-4">

            <?php foreach ($jadwalPerHari as $hari => $list): ?>

                <div class="col-12">
                    <div class="card jadwal-card h-100">

                        <div class="card-header fw-bold">
                            <?= strtoupper($hari) ?>
                        </div>

                        <div class="card-body">

                            <?php foreach ($list as $row): ?>
                                <div class="jadwal-detail mb-3">
                                    <div class="fw-bold"><?= $row['id_mk'] ?> - <?= $row['nama_mk'] ?></div>
                                    <div><?= $row['sks'] ?> SKS</div>
                                    <div>Kelas <?= $row['kelas'] ?></div>
                                    <div>Ruang  <?= $row['ruang'] ?></div>
                                    <div>
                                        Waktu 
                                        <?= substr($row['jam_mulai'], 0, 8) ?> -
                                        <?= substr($row['jam_selesai'], 0, 8) ?>
                                    </div>
                                </div>
                                <hr>
                            <?php endforeach; ?>

                        </div>
                    </div>
                </div>

            <?php endforeach; ?>

            </div>
        </div>
    </div>
</div>
</body>
</html>
