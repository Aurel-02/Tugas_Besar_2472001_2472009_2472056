<?php
session_start();

if (!isset($_SESSION['login']) || $_SESSION['role_id'] !== '2') {
    header("Location: /TUGAS_BESAR_2472001_2472009_2472056/login.php?role=2");
    exit;
}

include __DIR__ . "/../koneksi.php";

$nip = $_SESSION['user_id'];

$queryDosen = "SELECT id_prodi FROM tbdosen WHERE nip = '$nip'";
$resultDosen = $conn->query($queryDosen);
if (!$resultDosen || $resultDosen->num_rows == 0) {
    die("Data dosen tidak ditemukan.");
}
$dosen = $resultDosen->fetch_assoc();
$id_prodi = $dosen['id_prodi'];

$queryMK = "
    SELECT *
    FROM tbmatakuliah
    WHERE id_prodi = '$id_prodi'
    ORDER BY nama_mk
";
$resultMK = $conn->query($queryMK);
if (!$resultMK) {
    die("Query mata kuliah gagal: " . $conn->error);
}
$mataKuliah = $resultMK->fetch_all(MYSQLI_ASSOC);

$queryKelas = "SELECT DISTINCT kelas FROM tbperwalian";
$resultKelas = $conn->query($queryKelas);

$conn->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Lembar Penilaian Dosen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../css/nilai.css" />
</head>
<body>
<div class="container">
    <div class="form-container">
        <div class="header text-center">
            <h2>Lembar Penilaian Dosen</h2>
        </div>

        <form method="POST">

            <div class="form-group">
                <label>Mata Kuliah :</label>
                <select class="form-control" name="matkul">
                    <option value="">Pilih Mata Kuliah</option>
                    <?php foreach ($mataKuliah as $mk) { ?>
                        <option value="<?= $mk['id_mk']; ?>"><?= $mk['nama_mk']; ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="form-group">
                <label>Kelas :</label>
                <select class="form-control" name="kelas">
                    <?php while ($rowKelas = $resultKelas->fetch_assoc()) { ?>
                        <option value="<?= $rowKelas['kelas']; ?>"><?= $rowKelas['kelas']; ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="form-group">
                <label>Jenis Penilaian :</label>
                <div class="btn-group" role="group">
                    <input type="radio" class="btn-check" name="nilai" id="kat" value="KAT" />
                    <label class="btn btn-outline-primary" for="kat">KAT</label>

                    <input type="radio" class="btn-check" name="nilai" id="uts" value="UTS" />
                    <label class="btn btn-outline-primary" for="uts">UTS</label>

                    <input type="radio" class="btn-check" name="nilai" id="uas" value="UAS" />
                    <label class="btn btn-outline-primary" for="uas">UAS</label>
                </div>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary mt-4">Lanjut</button>
            </div>

        </form>
    </div>
</div>
</body>
</html>
