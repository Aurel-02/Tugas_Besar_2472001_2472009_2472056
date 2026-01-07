<?php
include "../../koneksi.php";
$id=$_POST['id'];
$nama=$_POST['nama'];
mysqli_query($conn,"UPDATE tbmatakuliah SET nama_mk='$nama' WHERE id_mk='$id'");
header("Location: index.php");
