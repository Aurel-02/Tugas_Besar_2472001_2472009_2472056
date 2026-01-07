<?php
include "../../koneksi.php";
mysqli_query($conn,"INSERT INTO tbjadwal VALUES(NULL,'$_POST[id_mk]','$_POST[nidn]','$_POST[hari]','$_POST[jam_mulai]','$_POST[jam_selesai]','$_POST[ruang]')");
header("Location:index.php");
