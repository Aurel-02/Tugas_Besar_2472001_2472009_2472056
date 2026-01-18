<?php
include "../../koneksi.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nip  = $_POST['nip'];
    $nama = $_POST['nama'];

    $stmt = $conn->prepare("CALL sp_update_dosen(?, ?)");
    $stmt->bind_param("ss", $nip, $nama);
    $stmt->execute();

    $stmt->close();
    $conn->next_result();

    header("Location: index.php?status=update_success");
    exit;
}
