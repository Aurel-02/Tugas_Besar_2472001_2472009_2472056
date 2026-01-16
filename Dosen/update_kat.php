<?php
session_start();

if (!isset($_SESSION['login']) || $_SESSION['role_id'] !== '2') {
    header("Location: ../../login.php?role=2");
    exit;
}

include __DIR__ . "/../../koneksi.php";

$nip   = $_SESSION['user_id'];
$id_mk = $_SESSION['id_mk'];

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['nilai'])) {
    header("Location: ../lembar_penilaian_kat.php");
    exit;
}

$stmt = $conn->prepare("CALL spUpdateNilaiKAT(?, ?, ?, ?)");

foreach ($_POST['nilai'] as $nrp => $nilai) {

    if ($nilai === '') continue;

    $id_transkrip = 'TR' . $nrp;

    $stmt->bind_param(
        "ssds",
        $id_transkrip,
        $id_mk,
        $nilai,
        $nip
    );
    $stmt->execute();
}

$stmt->close();
$conn->close();

header("Location: ../lembar_pennilaian_kat.php?sukses=1");
exit;
