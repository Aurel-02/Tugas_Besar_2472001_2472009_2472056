<?php
include "../../koneksi.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nip           = $_POST['nip'];
    $nama_dosen    = $_POST['nama_dosen'];
    $tempat_lahir  = $_POST['tempat_lahir'];
    $tgl_lahir     = $_POST['tgl_lahir'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $email         = $_POST['email'];
    $no_telp       = $_POST['no_telp'];
    $alamat        = $_POST['alamat'];
    $id_prodi      = $_POST['id_prodi'];

    $stmt = $conn->prepare("CALL sp_update_dosen(?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param(
        "ssssssssi",
        $nip,
        $nama_dosen,
        $tempat_lahir,
        $tgl_lahir,
        $jenis_kelamin,
        $email,
        $no_telp,
        $alamat,
        $id_prodi
    );

    if ($stmt->execute()) {
        $stmt->close();
        $conn->next_result();
        header("Location: index.php?status=update_success");
        exit;
    } else {
        echo "Terjadi kesalahan saat update data: " . $stmt->error;
    }
}
?>
