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
    <title>DKBS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/Tugas_Besar_2472001_2472009_2472056/css/sidebar.css">
    <link rel="stylesheet" href="/Tugas_Besar_2472001_2472009_2472056/css/dkbs.css">
</head>
<body>
<?php

include __DIR__ . '/../koneksi.php';

$nrp = $_SESSION['user_id'];

$querySemester = "
    SELECT MAX(p.semester) AS semester
    FROM tbdkbs d
    JOIN tbperwalian p ON d.id_perwalian = p.id_perwalian
    WHERE d.nrp = ?
";

$stmtSemester = $conn->prepare($querySemester);
$stmtSemester->bind_param("s", $nrp);
$stmtSemester->execute();
$dataSemester = $stmtSemester->get_result()->fetch_assoc();
$semesterMax = $dataSemester ? (int)$dataSemester['semester'] : 1;

$semesterAktif = $_GET['semester'] ?? null;

if (!$semesterAktif) {
    $semesterAktif = $semesterMax;
} elseif ($semesterAktif < 1 || $semesterAktif > $semesterMax) {
    $semesterAktif = $semesterMax;
}

$query = "
    SELECT 
        d.id_mk, 
        m.nama_mk, 
        p.jam_mulai, 
        p.jam_selesai, 
        p.kelas, 
        p.ruang, 
        p.sks
    FROM tbdkbs d
    JOIN tbperwalian p ON d.id_perwalian = p.id_perwalian
    JOIN tbmatakuliah m ON d.id_mk = m.id_mk
    WHERE d.nrp = ? 
      AND p.semester = ?
    ORDER BY p.jam_mulai
";

$stmt = $conn->prepare($query);
$stmt->bind_param("ss", $nrp, $semesterAktif);
$stmt->execute();
$result = $stmt->get_result();
?>

<div class="layout">

    <?php include __DIR__ . '/include/sidebar.php'; ?>

    <div class="main-content">

        <div class="dkbs-header d-flex justify-content-between align-items-center px-4">
            <h2 class="mb-0 text-white">DKBS</h2>
        </div>

        <div class="px-4 mt-4">
            <form method="GET" class="d-flex justify-content-between align-items-center mb-3">
                <label class="mb-0">Semester Perkuliahan</label>

                <select name="semester"
                        class="form-select form-select-sm w-auto ms-auto"
                        onchange="this.form.submit()">
                    <?php for ($i = 1; $i <= $semesterMax; $i++): ?>
                        <option value="<?= $i ?>" <?= ($semesterAktif == $i) ? 'selected' : '' ?>>
                            <?= $i ?>
                        </option>
                    <?php endfor; ?>
                </select>
            </form>
            
            <div class="card dkbs-card">
                <div class="card-body">
                    <?php
                    $total_sks = 0;

                    while ($row = $result->fetch_assoc()):
                        $jenis = '';
                        if (str_ends_with($row['id_mk'], 'T')) {
                            $jenis = 'Teori';
                        } elseif (str_ends_with($row['id_mk'], 'P')) {
                            $jenis = 'Praktikum';
                        }

                        $queryDosen = "
                            SELECT dos.nama_dosen
                            FROM tbperwalian p
                            JOIN tbdosen dos ON p.nip = dos.nip
                            WHERE p.id_perwalian = (SELECT id_perwalian FROM tbdkbs WHERE id_mk = ? AND nrp = ? LIMIT 1)
                        ";
                        $stmtDosen = $conn->prepare($queryDosen);
                        $stmtDosen->bind_param("ss", $row['id_mk'], $nrp);
                        $stmtDosen->execute();
                        $resultDosen = $stmtDosen->get_result();
                        $dosen = $resultDosen->fetch_assoc();

                        $total_sks += $row['sks'];
                    ?>
                    <div class="matkul-item mb-3">
                        <div class="d-flex justify-content-between">
                            <strong><?= $row['id_mk'] ?> - <?= $row['nama_mk'] ?></strong>
                            <span><?= substr($row['jam_mulai'], 0, 8) ?> - <?= substr($row['jam_selesai'], 0, 8) ?></span>
                        </div>
                        <div class="text-muted"><?= $jenis ?></div>
                        <div>
                            <small class="text-muted">
                                Kelas <?= $row['kelas'] ?> | Ruang <?= $row['ruang'] ?>
                            </small>
                            <div class="text-muted"><?= $dosen['nama_dosen'] ?></div>
                            <div><?= $row['sks'] ?> SKS</div>
                        </div>
                    </div>

                    <hr style="border: 1px solid ;">

                    <?php endwhile; ?>
                </div>
                <div class="card-footer">
                    <strong>Total SKS: <?= $total_sks ?> SKS</strong> 
                </div>
            </div>
            <div class="text-end mt-4">
                <a href="../mahasiswa/pilih_matkul.php" class="link-perwalian">
                    <img src="../img/edit_icon.png" alt="Edit Icon" class="icon" />
                    Lakukan Perwalian
                </a>
            </div>
        </div>
    </div>

</div>
</body>
</html>
