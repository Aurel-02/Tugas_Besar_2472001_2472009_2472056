<?php
include "../../koneksi.php";

$id_mk    = $_POST['id_mk'];
$nama_mk  = $_POST['nama_mk'];
$sks      = $_POST['sks'];
$id_prodi = $_POST['id_prodi'];

mysqli_query($conn, "
    UPDATE tbmatakuliah SET
        nama_mk  = '$nama_mk',
        sks      = '$sks',
        id_prodi = '$id_prodi'
    WHERE id_mk = '$id_mk'
");

header("Location: index.php");
