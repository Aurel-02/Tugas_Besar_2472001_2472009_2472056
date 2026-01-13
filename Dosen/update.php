<?php
session_start();
include __DIR__ . "/../koneksi.php";

if (!isset($_SESSION['login']) || $_SESSION['role_id'] !== '2') {
    exit('Akses ditolak');
}

/* Ambil data dari form */
$nip           = $_POST['nip'];
$email         = $_POST['email'];
$tgl_lahir     = $_POST['tgl_lahir'];
$tempat_lahir  = $_POST['tempat_lahir'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$no_telp       = $_POST['no_telp'];
$alamat        = $_POST['alamat'];

/* Panggil Stored Procedure */
$sql = "CALL sp_update_dosen(?,?,?,?,?,?,?)";
$stmt = $conn->prepare($sql);

$stmt->bind_param(
    "sssssss",
    $nip,
    $email,
    $tgl_lahir,
    $tempat_lahir,
    $jenis_kelamin,
    $no_telp,
    $alamat
);

$stmt->execute();

/* Redirect */
header("Location: profile.php?update=success");
exit;
