<?php
include "../../koneksi.php";
$id=$_GET['id'];
mysqli_query($conn,"DELETE FROM tbdosen WHERE nidn='$id'");
header("Location: index.php");
