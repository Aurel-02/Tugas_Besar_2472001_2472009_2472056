<?php
include __DIR__ . "/../koneksi.php"; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nrp = $_POST['nrp'] ?? ''; 
    if (empty($nrp) || $nrp == '0') {
        die("NRP tidak valid atau kosong!");
    }

    $tgl_lahir = $_POST['tgl_lahir'];
    $tempat_lahir = $_POST['tempat_lahir'];
    $email = $_POST['email'];
    $no_telp_mahasiswa = $_POST['no_telp_mahasiswa'];
    $alamat_mahasiswa = $_POST['alamat_mahasiswa'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $nama_wali = $_POST['nama_wali'];
    $email_wali = $_POST['email_wali'];
    $no_telp_wali = $_POST['no_telp_wali'];
    $alamat_wali = $_POST['alamat_wali'];


    if (empty($nrp)) {
        die("NRP tidak ditemukan!");
    }

    $sql = "CALL sp_UpdateMahasiswa(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"; 

    $stmt = $conn->prepare($sql);

    if ($stmt) {

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

        if ($stmt->execute()) {
            header("Location: profile.php");
            exit;
        } else {
            echo "Error: " . $stmt->error;
        }
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
}
?>
