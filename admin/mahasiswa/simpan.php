<?php
include "../../koneksi.php";
$nama = $_POST['nama_mahasiswa'];
mysqli_query($conn,"INSERT INTO tbmahasiswa VALUES(NULL,'$nama')");
header("Location:index.php");
