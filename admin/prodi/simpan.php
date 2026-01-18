<?php
include "../../koneksi.php";

$id_prodi    = $_POST['id_prodi'];
$nama_prodi  = $_POST['nama_prodi'];
$id_fakultas = $_POST['id_fakultas'];

mysqli_query($conn,"
    INSERT INTO tbprodi 
    (id_prodi, nama_prodi, id_fakultas)
    VALUES
    ('$id_prodi','$nama_prodi','$id_fakultas')
");

header("Location: index.php");
exit;
