<?php
include "../../koneksi.php";
$id=$_GET['id'];
mysqli_query($conn,"DELETE FROM tbmahasiswa WHERE nrp='$id'");
header("Location: index.php");
