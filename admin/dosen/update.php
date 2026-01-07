<?php
include "../../koneksi.php";
$nidn=$_POST['nidn'];
$nama=$_POST['nama'];
mysqli_query($conn,"UPDATE tbdosen SET nama_dosen='$nama' WHERE nidn='$nidn'");
header("Location: index.php");
