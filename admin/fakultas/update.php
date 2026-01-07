<?php
include "../../koneksi.php";
$id=$_POST['id'];
$nama=$_POST['nama_fakultas'];
mysqli_query($conn,"UPDATE tbfakultas SET nama_fakultas='$nama' WHERE id_fakultas='$id'");
header("Location:index.php");
