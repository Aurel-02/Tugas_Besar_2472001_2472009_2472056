<?php
include "../../koneksi.php";

$id         = $_POST['id_perwalian'];
$hari       = $_POST['hari'];
$jam_mulai  = $_POST['jam_mulai'];
$jam_selesai= $_POST['jam_selesai'];
$id_mk      = $_POST['id_mk'];
$nip        = $_POST['nip'];
$ruang      = $_POST['ruang'];

mysqli_query($conn, "
    UPDATE tbperwalian SET
        hari = '$hari',
        jam_mulai = '$jam_mulai',
        jam_selesai = '$jam_selesai',
        id_mk = '$id_mk',
        nip = '$nip',
        ruang = '$ruang'
    WHERE id_perwalian = '$id'
");

header("Location: index.php");
