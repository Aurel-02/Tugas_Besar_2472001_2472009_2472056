<?php
session_start();

if (!isset($_SESSION['login']) || $_SESSION['role_id'] !== '2') {
    header("Location: ../login.php?role=2");
    exit;
}

include __DIR__ . "/../koneksi.php";

/* =========================
   DATA PILIHAN DARI nilai.php
========================= */
$nip        = $_SESSION['user_id'];
$id_mk      = $_SESSION['id_mk'];
$kelas      = $_SESSION['kelas'];
$jenisNilai = $_SESSION['jenis_nilai'];

/* =========================
   DATA DOSEN
========================= */
$dosen = $conn->query("
    SELECT nama_dosen 
    FROM tbdosen 
    WHERE nip = '$nip'
")->fetch_assoc();

/* =========================
   DATA MK + SEMESTER
========================= */
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

/* =========================
   AMBIL MAHASISWA (FIX)
   tbtranskrip → tbmahasiswa
========================= */
$qMhs = $conn->query("
    SELECT DISTINCT
        m.nrp,
        m.nama_mahasiswa
    FROM tbtranskrip t
    JOIN tbmahasiswa m ON t.nrp = m.nrp
    WHERE t.semester = '$semester'
    ORDER BY m.nama_mahasiswa ASC
");

/* =========================
   SIMPAN NILAI
========================= */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($_POST['nilai'] as $nrp => $nilai) {

        $cek = $conn->query("
            SELECT 1 FROM tbnilai
            WHERE nrp = '$nrp'
              AND id_mk = '$id_mk'
              AND jenis_nilai = '$jenisNilai'
        ");

        if ($cek->num_rows == 0) {
            $conn->query("
                INSERT INTO tbnilai (nrp, id_mk, jenis_nilai, nilai)
                VALUES ('$nrp', '$id_mk', '$jenisNilai', '$nilai')
            ");
        } else {
            $conn->query("
                UPDATE tbnilai
                SET nilai = '$nilai'
                WHERE nrp = '$nrp'
                  AND id_mk = '$id_mk'
                  AND jenis_nilai = '$jenisNilai'
            ");
        }
    }

    echo "<script>alert('Nilai berhasil disimpan');</script>";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Lembar Penilaian KAT</title>
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
            <p><b>Jenis Nilai</b> : <?= $jenisNilai ?></p>
        </div>
    </div>

    <form method="POST">
        <table>
            <thead>
                <tr>
                    <th>NRP</th>
                    <th>Nama Mahasiswa</th>
                    <th>Nilai</th>
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
                               name="nilai[<?= $m['nrp'] ?>]"
                               min="0" max="100" required>
                    </td>
                </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3" align="center">Tidak ada mahasiswa</td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>

        <div class="button-area">
            <button type="submit" class="btn btn-submit">Edit</button>
            <button type="submit" class="btn btn-submit">Submit</button>
        </div>
    </form>

</div>

</body>
</html>
