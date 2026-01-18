<?php
include "../../koneksi.php";

$hari        = $_POST['hari'];
$id_mk       = $_POST['id_mk'];
$nip         = $_POST['nip'];
$jam_mulai   = $_POST['jam_mulai'];
$jam_selesai = $_POST['jam_selesai'];
$ruang       = $_POST['ruang'];

mysqli_query($conn, "
    INSERT INTO tbperwalian
    (hari, id_mk, nip, jam_mulai, jam_selesai, ruang)
    VALUES
    ('$hari', '$id_mk', '$nip', '$jam_mulai', '$jam_selesai', '$ruang')
");

header("Location: index.php");
exit;
