<?php
include "../../koneksi.php";
$id=$_POST['id'];
$nama=$_POST['nama'];
mysqli_query($conn,"UPDATE tbprodi SET nama_prodi='$nama' WHERE id_prodi='$id'");
header("Location: index.php");
