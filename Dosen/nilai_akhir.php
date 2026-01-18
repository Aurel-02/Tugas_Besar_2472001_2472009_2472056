<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

if (!isset($_SESSION['login']) || $_SESSION['role_id'] !== '2') {
    header("Location: ../login.php?role=2");
    exit;
}

include __DIR__ . "/../koneksi.php";

while ($conn->more_results() && $conn->next_result()) {
    $conn->store_result();
}

$nip   = $_SESSION['user_id'];
$id_mk = $_SESSION['id_mk'];
$kelas = $_SESSION['kelas'];

$dosen = $conn->query("
    SELECT nama_dosen 
    FROM tbdosen 
    WHERE nip = '$nip'
")->fetch_assoc();

/* DATA MK */
$mk = $conn->query("
    SELECT nama_mk 
    FROM tbmatakuliah 
    WHERE id_mk = '$id_mk'
")->fetch_assoc();

/* SEMESTER */
$semesterRow = $conn->query("
    SELECT semester
    FROM tbperwalian
    WHERE nip = '$nip'
      AND id_mk = '$id_mk'
      AND kelas = '$kelas'
    LIMIT 1
")->fetch_assoc();

$semester = $semesterRow['semester'] ?? '-';

/* DATA NILAI AKHIR */
$stmt = $conn->prepare("
    SELECT DISTINCT
        m.nrp,
        m.nama_mahasiswa,
        n.nilai_kat,
        n.nilai_uts,
        n.nilai_uas,

        hitung_nilai_mutu(
            n.nilai_kat,
            n.nilai_uts,
            n.nilai_uas,
            60,20,20
        ) AS nilai_akhir,

        hitung_nilai_huruf(
            hitung_nilai_mutu(
                n.nilai_kat,
                n.nilai_uts,
                n.nilai_uas,
                60,20,20
            )
        ) AS nilai_mutu

    FROM tbdkbs d
    JOIN tbmahasiswa m ON d.nrp = m.nrp
    JOIN tbperwalian p ON d.id_perwalian = p.id_perwalian
    LEFT JOIN tbnilai n 
        ON n.id_transkrip = CONCAT('01-', m.nrp)
       AND n.id_mk = ?
    WHERE p.nip = ?
      AND p.id_mk = ?
      AND p.kelas = ?
    ORDER BY m.nama_mahasiswa ASC
");

$stmt->bind_param("ssss", $id_mk, $nip, $id_mk, $kelas);
$stmt->execute();
$qMhs = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Nilai Akhir Mahasiswa</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/Tugas_Besar_2472001_2472009_2472056/css/penilaian.css">
</head>
<body>

<div class="container mt-4">

    <div class="header text-center mb-4">
        <div class="icon">🎓</div>
        <h2>Nilai Akhir Mahasiswa</h2>
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
            <p><b>Mata Kuliah:</b> <?= $mk['nama_mk'] ?? '-' ?></p>
            <p><b>Kelas:</b> <?= $kelas ?></p>
            <p><b>Dosen:</b> <?= $dosen['nama_dosen'] ?? '-' ?></p>
        </div>
        <div class="col-md-6">
            <p><b>Semester:</b> <?= $semester ?></p>
            <p><b>Jenis Nilai:</b> Akhir</p>
        </div>
    </div>

    <table class="table table-bordered table-striped">
        <thead class="table-dark text-center">
            <tr>
                <th>NRP</th>
                <th>Nama</th>
                <th>KAT</th>
                <th>UTS</th>
                <th>UAS</th>
                <th>Nilai Akhir</th>
                <th>Mutu</th>
            </tr>
        </thead>
        <tbody>
        <?php if ($qMhs->num_rows > 0): ?>
            <?php while ($m = $qMhs->fetch_assoc()): ?>
            <tr class="text-center">
                <td><?= $m['nrp'] ?></td>
                <td class="text-start"><?= $m['nama_mahasiswa'] ?></td>
                <td><?= $m['nilai_kat'] ?? '-' ?></td>
                <td><?= $m['nilai_uts'] ?? '-' ?></td>
                <td><?= $m['nilai_uas'] ?? '-' ?></td>
                <td><b><?= $m['nilai_akhir'] ?? '-' ?></b></td>
                <td>
                    <span class="badge 
                        <?= in_array($m['nilai_mutu'], ['A','A-']) ? 'bg-success' :
                            (in_array($m['nilai_mutu'], ['B+','B']) ? 'bg-primary' :
                            (in_array($m['nilai_mutu'], ['C+','C']) ? 'bg-warning' : 'bg-danger')) ?>">
                        <?= $m['nilai_mutu'] ?? '-' ?>
                    </span>
                </td>
            </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="7" class="text-center">Tidak ada data</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
