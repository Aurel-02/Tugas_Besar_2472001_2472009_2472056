<?php
include "../../koneksi.php";

$id_mk  = $_POST['id_mk'];
$nama   = $_POST['nama_mk'];

mysqli_query($conn,"
    INSERT INTO tbmatakuliah (id_mk, nama_mk)
    VALUES ('$id_mk', '$nama')
");

header("Location: index.php");
