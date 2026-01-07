<?php
include "../../koneksi.php";
$id=$_GET['id'];
mysqli_query($conn,"DELETE FROM tbprodi WHERE id_prodi='$id'");
header("Location: index.php");
