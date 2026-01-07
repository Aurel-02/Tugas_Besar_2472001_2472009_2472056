<?php
include "../../koneksi.php";
$nama = $_POST['nama_fakultas'];
mysqli_query($conn,"INSERT INTO tbfakultas VALUES(NULL,'$nama')");
header("Location:index.php");
