<?php
session_start();

if (!isset($_SESSION['login']) || $_SESSION['role_id'] !== '2') {
    header("Location: ../login.php?role=2");
    exit;
}

include __DIR__ . "/../koneksi.php";

/* =========================
   DATA PILIHAN
========================= */
$nip   = $_SESSION['user_id'];
$id_mk = $_SESSION['id_mk'];
$kelas = $_SESSION['kelas'];

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
   AMBIL MAHASISWA + NILAI KAT
========================= */
$stmt = $conn->prepare("
    SELECT DISTINCT
        m.nrp,
        m.nama_mahasiswa,
        n.nilai_kat
    FROM tbdkbs d
    JOIN tbmahasiswa m ON d.nrp = m.nrp
    JOIN tbperwalian p ON d.id_perwalian = p.id_perwalian
    LEFT JOIN tbnilai n 
        ON n.id_transkrip = CONCAT('TR', m.nrp)
       AND n.id_mk = ?
    WHERE p.nip = ?
      AND p.id_mk = ?
      AND p.kelas = ?
    ORDER BY m.nama_mahasiswa ASC
");

$stmt->bind_param("ssss", $id_mk, $nip, $id_mk, $kelas);
$stmt->execute();
$qMhs = $stmt->get_result();

/* =========================
   SIMPAN NILAI KAT
========================= */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($_POST['nilai'] as $nrp => $nilai) {

        $id_transkrip = 'TR' . $nrp;

        $cek = $conn->query("
            SELECT 1 FROM tbnilai
            WHERE id_transkrip = '$id_transkrip'
              AND id_mk = '$id_mk'
        ");

        if ($cek->num_rows == 0) {
            $conn->query("
                INSERT INTO tbnilai (id_transkrip, id_mk, nilai_kat, nip)
                VALUES ('$id_transkrip', '$id_mk', '$nilai', '$nip')
            ");
        } else {
            $conn->query("
                UPDATE tbnilai
                SET nilai_kat = '$nilai'
                WHERE id_transkrip = '$id_transkrip'
                  AND id_mk = '$id_mk'
            ");
        }
    }

    echo "<script>
        alert('Nilai KAT berhasil disimpan');
        window.location.href = window.location.href;
    </script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Lembar Penilaian</title>

    <!-- Bootstrap -->
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
        <table>
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
                    <td>
                        <input type="number"
                               name="nilai[<?= $m['nrp'] ?>]"
                               value="<?= htmlspecialchars($m['nilai_kat'] ?? '') ?>"
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
            <button type="button"
                    class="btn btn-submit"
                    data-bs-toggle="modal"
                    data-bs-target="#editNilaiModal">
                Edit
            </button>

            <button type="submit" class="btn btn-submit">
                Submit
            </button>
        </div>
    </form>

</div>

<!-- MODAL -->
<div class="modal fade" id="editNilaiModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Edit Data Dosen</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <p class="text-muted">
                    Silakan edit nilai langsung di tabel, lalu klik <b>Submit</b>.
                </p>
            </div>

        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
