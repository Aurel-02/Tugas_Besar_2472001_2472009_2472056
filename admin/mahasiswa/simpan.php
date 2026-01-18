<?php
include "../../koneksi.php";

$nama     = $_POST['nama'];
$id_prodi = $_POST['id_prodi'];
$angkatan = $_POST['angkatan'];

$stmt = $conn->prepare("CALL sp_InsertMahasiswa(?, ?, ?)");
$stmt->bind_param("sss", $nama, $id_prodi, $angkatan);
$stmt->execute();

$stmt->close();
$conn->next_result();

header("Location: index.php");
exit;
