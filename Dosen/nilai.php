<?php
session_start();

if (!isset($_SESSION['login']) || $_SESSION['role_id'] !== '2') {
    header("Location: /TUGAS_BESAR_2472001_2472009_2472056/login.php?role=2");
    exit;
}

include __DIR__ . "/../koneksi.php";

$nip = $_SESSION['user_id'];

/* =========================
   HANDLE SUBMIT FORM
========================= */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $_SESSION['id_mk'] = $_POST['matkul'];
    $_SESSION['kelas'] = $_POST['kelas'];
    $_SESSION['jenis_nilai'] = $_POST['nilai'];

    if ($_POST['nilai'] === 'KAT') {
        header("Location: lembar_penilaian_kat.php");
    } elseif ($_POST['nilai'] === 'UTS') {
        header("Location: lembar_penilaian_uts.php");
    } elseif ($_POST['nilai'] === 'UAS') {
        header("Location: lembar_penilaian_uas.php");
    }
    exit;
}

/* =========================
   Ambil Prodi Dosen
========================= */
$qDosen = $conn->query("SELECT id_prodi FROM tbdosen WHERE nip='$nip'");
if (!$qDosen || $qDosen->num_rows == 0) {
    die("Data dosen tidak ditemukan");
}
$id_prodi = $qDosen->fetch_assoc()['id_prodi'];

/* =========================
   Mata Kuliah & Kelas
========================= */
$query = "
    SELECT DISTINCT
        pw.semester,
        mk.id_mk,
        mk.nama_mk,
        pw.kelas
    FROM tbperwalian pw
    JOIN tbmatakuliah mk ON pw.id_mk = mk.id_mk
    WHERE mk.id_prodi='$id_prodi'
      AND pw.nip='$nip'
    ORDER BY pw.semester, mk.nama_mk, pw.kelas
";
$result = $conn->query($query);

$dataMK = [];
$kelasList = [];

while ($row = $result->fetch_assoc()) {
    $dataMK[$row['semester']][] = [
        'id_mk' => $row['id_mk'],
        'nama_mk' => $row['nama_mk']
    ];
    $kelasList[$row['kelas']] = $row['kelas'];
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Nilai Dosen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/nilai.css">
</head>

<body>
<div class="container mt-4">
    <h3 class="text-center mb-4">Input Nilai Dosen</h3>

    <form method="POST">

        <!-- Mata Kuliah -->
        <div class="mb-3">
            <label class="form-label">Mata Kuliah</label>
            <select name="matkul" class="form-select" required>
                <option value="">Pilih Mata Kuliah</option>
                <?php foreach ($dataMK as $semester => $mkList): ?>
                    <optgroup label="Semester <?= $semester ?>">
                        <?php foreach ($mkList as $mk): ?>
                            <option value="<?= $mk['id_mk'] ?>">
                                <?= $mk['nama_mk'] ?>
                            </option>
                        <?php endforeach; ?>
                    </optgroup>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Kelas -->
        <div class="mb-3">
            <label class="form-label">Kelas</label>
            <select name="kelas" class="form-select" required>
                <option value="">Pilih Kelas</option>
                <?php foreach ($kelasList as $kelas): ?>
                    <option value="<?= $kelas ?>"><?= $kelas ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Jenis Penilaian -->
        <div class="mb-3">
            <label class="form-label">Jenis Penilaian</label><br>
            <div class="btn-group" role="group">
                <input type="radio" class="btn-check" name="nilai" id="kat" value="KAT" required>
                <label class="btn btn-outline-primary" for="kat">KAT</label>

                <input type="radio" class="btn-check" name="nilai" id="uts" value="UTS">
                <label class="btn btn-outline-primary" for="uts">UTS</label>

                <input type="radio" class="btn-check" name="nilai" id="uas" value="UAS">
                <label class="btn btn-outline-primary" for="uas">UAS</label>
            </div>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary px-5">
                Lanjut
            </button>
        </div>

    </form>
</div>
</body>
</html>
