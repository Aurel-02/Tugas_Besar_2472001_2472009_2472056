<?php
include "../../koneksi.php";

$id_fakultas   = $_POST['id_fakultas'];
$nama_fakultas = $_POST['nama_fakultas'];

mysqli_query($conn,"
    INSERT INTO tbfakultas 
    (id_fakultas, nama_fakultas)
    VALUES
    ('$id_fakultas','$nama_fakultas')
");

header("Location: index.php");
exit;
