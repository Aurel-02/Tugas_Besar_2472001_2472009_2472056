<?php
include "../../koneksi.php";

$nrp  = $_POST['nrp'];
$nama = $_POST['nama'];

mysqli_query($conn,"
    INSERT INTO tbmahasiswa (nrp, nama_mahasiswa)
    VALUES ('$nrp', '$nama')
");

header("Location: index.php");
