<?php
include "../../koneksi.php";
mysqli_query($conn,"INSERT INTO tbmatakuliah VALUES(NULL,'$_POST[nama_mk]','$_POST[sks]','$_POST[id_prodi]')");
header("Location:index.php");
