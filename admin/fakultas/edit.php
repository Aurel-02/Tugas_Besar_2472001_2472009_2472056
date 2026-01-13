<?php
session_start();
include "../../koneksi.php";

$id = $_GET['id'];
$data = mysqli_query($conn,"SELECT * FROM tbfakultas WHERE id_fakultas='$id'");
$row = mysqli_fetch_assoc($data);

if(isset($_POST['update'])){
    $kode = $_POST['kode'];
    $nama = $_POST['nama'];

    mysqli_query($conn,"UPDATE tbfakultas SET
        kode_fakultas='$kode',
        nama_fakultas='$nama'
        WHERE id_fakultas='$id'
    ");

    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">

<h4>Edit Fakultas</h4>

<form method="post">
    <div class="mb-3">
        <label>Kode Fakultas</label>
        <input type="text" name="kode" value="<?= $row['kode_fakultas']; ?>" class="form-control">
    </div>
    <div class="mb-3">
        <label>Nama Fakultas</label>
        <input type="text" name="nama" value="<?= $row['nama_fakultas']; ?>" class="form-control">
    </div>

    <button name="update" class="btn btn-warning">Update</button>
    <a href="index.php" class="btn btn-secondary">Kembali</a>
</form>

</body>
</html>
