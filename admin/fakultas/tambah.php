<?php
session_start();
include "../../koneksi.php";

if(isset($_POST['simpan'])){
    $kode = $_POST['kode'];
    $nama = $_POST['nama'];

    mysqli_query($conn,"INSERT INTO tbfakultas VALUES(NULL,'$kode','$nama')");
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">

<h4>Tambah Fakultas</h4>

<form method="post">
    <div class="mb-3">
        <label>Kode Fakultas</label>
        <input type="text" name="kode" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Nama Fakultas</label>
        <input type="text" name="nama" class="form-control" required>
    </div>

    <button name="simpan" class="btn btn-primary">Simpan</button>
    <a href="index.php" class="btn btn-secondary">Kembali</a>
</form>

</body>
</html>
