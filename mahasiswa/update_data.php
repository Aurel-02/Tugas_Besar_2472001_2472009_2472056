<?php
session_start();
include __DIR__ . "/../koneksi.php";


if (!isset($_SESSION['login']) || $_SESSION['role_id'] !== '3') {
    exit('Akses ditolak');
}


$nrp               = $_POST['nrp'];
$tgl_lahir         = $_POST['tgl_lahir'];
$tempat_lahir      = $_POST['tempat_lahir'];
$jenis_kelamin     = $_POST['jenis_kelamin'];
$email             = $_POST['email'];
$no_telp_mahasiswa = $_POST['no_telp_mahasiswa'];
$alamat_mahasiswa  = $_POST['alamat_mahasiswa'];
$nama_wali         = $_POST['nama_wali'];
$alamat_wali       = $_POST['alamat_wali'];
$no_telp_wali      = $_POST['no_telp_wali'];
$email_wali        = $_POST['email_wali'];


$sql = "CALL sp_UpdateMahasiswa(?,?,?,?,?,?,?,?,?,?,?)";
$stmt = $conn->prepare($sql);

$stmt->bind_param(
    "sssssssssss",
    $nrp,
    $tgl_lahir,
    $tempat_lahir,
    $jenis_kelamin,
    $email,
    $no_telp_mahasiswa,
    $alamat_mahasiswa,
    $nama_wali,
    $alamat_wali,
    $no_telp_wali,
    $email_wali
);

$stmt->execute();

header("Location: profile.php?update=success");
exit;
