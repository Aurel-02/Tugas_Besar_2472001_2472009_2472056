<?php
session_start();

if (!isset($_SESSION['login']) || $_SESSION['role_id'] !== '2') {
    header("Location: ../login.php?role=2");
    exit;
}

include __DIR__ . "/../koneksi.php";

$nip   = $_SESSION['user_id'];
$id_mk = $_SESSION['id_mk'];
$kelas = $_SESSION['kelas'];

$dosen = $conn->query("
    SELECT nama_dosen 
    FROM tbdosen 
    WHERE nip = '$nip'
")->fetch_assoc();


$mk = $conn->query("
    SELECT nama_mk 
    FROM tbmatakuliah 
    WHERE id_mk = '$id_mk'
")->fetch_assoc();

$semesterRow = $conn->query("
    SELECT semester
    FROM tbperwalian
    WHERE nip = '$nip'
      AND id_mk = '$id_mk'
      AND kelas = '$kelas'
    LIMIT 1
")->fetch_assoc();

$semester = $semesterRow['semester'] ?? '-';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nilai'])) {

    $stmtSP = $conn->prepare(
        "CALL spSimpanNilaiLengkap(?, ?, ?, ?, ?)"
    );

    foreach ($_POST['nilai'] as $nrp => $nilai) {

        if ($nilai === '') continue;

        $id_transkrip = '01-' . $nrp;
        $jenis = 'KAT';

        $stmtSP->bind_param(
            "sssds",
            $id_transkrip,
            $id_mk,
            $nip,
            $nilai,
            $jenis
        );

        $stmtSP->execute();
        $conn->next_result(); 
    }

    $stmtSP->close();

    echo "<script>
        alert('Nilai KAT berhasil disimpan');
        window.location.href = window.location.href;
    </script>";
    exit;
}

$stmt = $conn->prepare("
    SELECT DISTINCT
        m.nrp,
        m.nama_mahasiswa,
        n.nilai_kat
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
    <title>Lembar Penilaian KAT</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/penilaian.css">
</head>
<body>

<div class="container">

    <div class="header">
        <div class="icon">🎓</div>
        <h1>Lembar Penilaian Dosen</h1>
    </div>

    <div class="info">
        <div>
            <p><b>Mata Kuliah</b> : <?= $mk['nama_mk'] ?></p>
            <p><b>Kelas</b> : <?= $kelas ?></p>
            <p><b>Dosen</b> : <?= $dosen['nama_dosen'] ?></p>
        </div>
        <div>
            <p><b>Semester</b> : <?= $semester ?></p>
            <p><b>Jenis Nilai</b> : KAT</p>
        </div>
    </div>

    <form method="POST">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>NRP</th>
                    <th>Nama Mahasiswa</th>
                    <th>Nilai KAT</th>
                </tr>
            </thead>
            <tbody>
            <?php if ($qMhs->num_rows > 0): ?>
                <?php while ($m = $qMhs->fetch_assoc()): ?>
                <tr>
                    <td><?= $m['nrp'] ?></td>
                    <td><?= $m['nama_mahasiswa'] ?></td>
                    <td width="150">
                        <input type="number"
                               class="form-control text-center"
                               name="nilai[<?= $m['nrp'] ?>]"
                               value="<?= htmlspecialchars($m['nilai_kat'] ?? '') ?>"
                               min="0" max="100">
                    </td>
                </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3" class="text-center">Tidak ada mahasiswa</td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>

        <div class="text-end">
            <button type="submit" class="btn btn-primary px-4">
                Submit
            </button>
        </div>
    </form>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
