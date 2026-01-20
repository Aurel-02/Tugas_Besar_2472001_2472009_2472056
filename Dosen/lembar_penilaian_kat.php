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

/* ================== DATA DOSEN ================== */
$dosen = $conn->query("
    SELECT nama_dosen 
    FROM tbdosen 
    WHERE nip = '$nip'
")->fetch_assoc();

/* ================== DATA MK ================== */
$mk = $conn->query("
    SELECT nama_mk 
    FROM tbmatakuliah 
    WHERE id_mk = '$id_mk'
")->fetch_assoc();

/* ================== SEMESTER ================== */
$semesterRow = $conn->query("
    SELECT semester
    FROM tbperwalian
    WHERE nip = '$nip'
      AND id_mk = '$id_mk'
      AND kelas = '$kelas'
    LIMIT 1
")->fetch_assoc();

$semester = $semesterRow['semester'] ?? '-';

/* ================== SIMPAN NILAI ================== */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nilai'])) {

    foreach ($_POST['nilai'] as $nrp => $nilai) {

        if ($nilai === '' || $nilai === null) continue;

        $id_transkrip = '01-' . $nrp . '-' . $id_mk;
        $jenis = 'KAT';

        $stmtSP = $conn->prepare(
            "CALL spSimpanNilaiLengkap(?, ?, ?, ?, ?)"
        );

        $stmtSP->bind_param(
            "sssds",
            $id_transkrip,
            $id_mk,
            $nip,
            $nilai,
            $jenis
        );

        if (!$stmtSP->execute()) {
            die("Error SP: " . $stmtSP->error);
        }

        $stmtSP->close();
        $conn->next_result();
    }

    echo "<script>
        alert('Nilai KAT berhasil disimpan');
        location.reload();
    </script>";
    exit;
}

/* ================== AMBIL MAHASISWA ================== */
$stmt = $conn->prepare("
    SELECT
        m.nrp,
        m.nama_mahasiswa,
        n.nilai_kat
    FROM tbdkbs d
    JOIN tbmahasiswa m ON d.nrp = m.nrp
    JOIN tbperwalian p ON d.id_perwalian = p.id_perwalian
    LEFT JOIN tbnilai n 
        ON n.id_transkrip = CONCAT('01-', m.nrp, '-', ?)
       AND n.id_mk = ?
    WHERE p.nip = ?
      AND p.id_mk = ?
      AND p.kelas = ?
    ORDER BY m.nama_mahasiswa ASC
");

$stmt->bind_param("sssss", $id_mk, $id_mk, $nip, $id_mk, $kelas);
$stmt->execute();
$qMhs = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Lembar Penilaian KAT</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">

    <h3 class="text-center mb-4">Lembar Penilaian Dosen</h3>

    <div class="row mb-3">
        <div class="col-md-6">
            <p><b>Mata Kuliah</b> : <?= $mk['nama_mk'] ?></p>
            <p><b>Kelas</b> : <?= $kelas ?></p>
            <p><b>Dosen</b> : <?= $dosen['nama_dosen'] ?></p>
        </div>
        <div class="col-md-6">
            <p><b>Semester</b> : <?= $semester ?></p>
            <p><b>Jenis Nilai</b> : KAT</p>
        </div>
    </div>

    <form method="POST">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>NRP</th>
                    <th>Nama Mahasiswa</th>
                    <th width="150">Nilai KAT</th>
                </tr>
            </thead>
            <tbody>
            <?php if ($qMhs->num_rows > 0): ?>
                <?php while ($m = $qMhs->fetch_assoc()): ?>
                <tr>
                    <td><?= $m['nrp'] ?></td>
                    <td><?= $m['nama_mahasiswa'] ?></td>
                    <td>
                        <input type="number"
                               class="form-control text-center"
                               name="nilai[<?= $m['nrp'] ?>]"
                               value="<?= $m['nilai_kat'] ?>"
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
                Simpan Nilai
            </button>
        </div>
    </form>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
