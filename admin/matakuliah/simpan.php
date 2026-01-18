<?php
include "../../koneksi.php";

$id_mk    = $_POST['id_mk'];
$nama_mk  = $_POST['nama_mk'];
$sks      = $_POST['sks'];
$id_prodi = $_POST['id_prodi'];

$query = "
    INSERT INTO tbmatakuliah 
    (id_mk, nama_mk, sks, id_prodi)
    VALUES
    ('$id_mk', '$nama_mk', '$sks', '$id_prodi')
";

mysqli_query($conn, $query);

header("Location: index.php");
