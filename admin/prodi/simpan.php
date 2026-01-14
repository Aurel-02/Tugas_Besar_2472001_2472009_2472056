<?php
include "../../koneksi.php";

$id   = $_POST['id_prodi'];
$nama = $_POST['nama_prodi'];

mysqli_query($conn,"
    INSERT INTO tbprodi (id_prodi, nama_prodi)
    VALUES ('$id', '$nama')
");

header("Location: index.php");
