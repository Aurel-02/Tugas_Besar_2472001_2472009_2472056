<?php
include __DIR__ . "/../koneksi.php"; // Koneksi ke database

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $nrp = $_POST['nrp'] ?? ''; // Ambil nilai NRP yang dikirimkan
    if (empty($nrp) || $nrp == '0') {
        die("NRP tidak valid atau kosong!");
    }

    // Ambil data lain yang bisa diubah
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

    // Validasi NRP
    if (empty($nrp)) {
        die("NRP tidak ditemukan!");
    }

    // Query Update hanya untuk data yang bisa diubah
    $sql = "
        UPDATE tbmahasiswa 
        SET 
            tgl_lahir = ?, 
            tempat_lahir = ?, 
            email = ?, 
            no_telp_mahasiswa = ?, 
            alamat_mahasiswa = ?, 
            jenis_kelamin = ?, 
            nama_wali = ?, 
            email_wali = ?, 
            no_telp_wali = ?, 
            alamat_wali = ?
        WHERE nrp = ?"; 

    // Persiapkan statement
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Bind parameter
        $stmt->bind_param(
            "sssssssssss", 
            $tgl_lahir, 
            $tempat_lahir, 
            $email, 
            $no_telp_mahasiswa, 
            $alamat_mahasiswa, 
            $jenis_kelamin, 
            $nama_wali, 
            $email_wali, 
            $no_telp_wali, 
            $alamat_wali, 
            $nrp
        );

        // Eksekusi query
        if ($stmt->execute()) {
            // Redirect ke halaman profil setelah update sukses
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
