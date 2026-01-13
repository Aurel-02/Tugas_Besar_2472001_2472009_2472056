<?php
include "../../koneksi.php";
$id = $_GET['id'];

mysqli_query($conn,"DELETE FROM tbfakultas WHERE id_fakultas='$id'");
header("Location: index.php");
