<?php
session_start();
include "../koneksi.php";

if(!isset($_SESSION['login']) || $_SESSION['role_id'] != 1){
    header("Location: ../index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Dashboard Admin</title>

<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Custom CSS -->
<link rel="stylesheet" href="../css/admin.css">
</head>
<body>

<div class="wrapper">

    <!-- SIDEBAR -->
    <aside class="sidebar">
        <div class="brand">
            <span class="icon">🛡️</span> Portal Admin
        </div>

        <ul class="menu">
            <li class="active"><a href="#">Dashboard</a></li>
            <li><a href="fakultas/index.php">Fakultas</a></li>
            <li><a href="prodi/index.php">Program Studi</a></li>
            <li><a href="mahasiswa/index.php">Mahasiswa</a></li>
            <li><a href="dosen/index.php">Dosen</a></li>
            <li><a href="matakuliah/index.php">Mata Kuliah</a></li>
            <li><a href="jadwal/index.php">Jadwal</a></li>
            <li class="logout"><a href="../logout.php">Logout</a></li>
        </ul>
    </aside>

    <!-- MAIN -->
    <main class="main">

        <!-- TOPBAR -->
        <div class="topbar">
            <h6>Dashboard</h6>
            <div class="user">
                <span><?= $_SESSION['nama'] ?></span>
                <div class="avatar"></div>
            </div>
        </div>

        <!-- CONTENT -->
        <div class="content">

            <!-- SMALL CARDS -->
            <div class="stats">
                <div class="stat-card"></div>
                <div class="stat-card"></div>
                <div class="stat-card"></div>
                <div class="stat-card"></div>
            </div>

            <!-- BIG CARD -->
            <div class="big-card"></div>

        </div>

    </main>

</div>

</body>

</html>
