<?php
include "../../koneksi.php";

$hari    = $_POST['hari'];
$mulai   = $_POST['jam_mulai'];
$selesai = $_POST['jam_selesai'];
$mk      = $_POST['nama_mk'];
$nip     = $_POST['nip'];
$ruang   = $_POST['ruang'];

mysqli_query($conn,"
    INSERT INTO tbdkbs (hari, jam_mulai, jam_selesai, nama_mk, nip, ruang)
    VALUES ('$hari','$mulai','$selesai','$mk','$nip','$ruang')
");

header("Location: index.php");
