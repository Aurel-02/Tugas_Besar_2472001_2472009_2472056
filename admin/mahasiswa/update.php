<?php
include "../../koneksi.php";
$nrp=$_POST['nrp'];
$nama=$_POST['nama'];
mysqli_query($conn,"UPDATE tbmahasiswa SET nama_mahasiswa='$nama' WHERE nrp='$nrp'");
header("Location: index.php");
