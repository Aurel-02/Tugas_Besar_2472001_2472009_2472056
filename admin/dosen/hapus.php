<?php
include "../../koneksi.php";

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$nip = $_GET['id'];

$stmt = $conn->prepare("CALL sp_delete_dosen(?)");
$stmt->bind_param("s", $nip);
$stmt->execute();

$stmt->close();
$conn->next_result();

header("Location: index.php?status=delete_success");
exit;
