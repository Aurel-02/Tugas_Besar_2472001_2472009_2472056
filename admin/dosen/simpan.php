<?php
include "../../koneksi.php";
$nama = $_POST['nama_dosen'];
mysqli_query($conn,"INSERT INTO tbdosen VALUES(NULL,'$nama')");
header("Location:index.php");
