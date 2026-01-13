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

<div class="d-flex">

    <!-- SIDEBAR -->
    <div class="sidebar p-3">
        <h4 class="text-center text-white mb-4">ADMIN PANEL</h4>

        <div class="text-center text-white mb-4">
            👤 <?= $_SESSION['nama'] ?>
        </div>

        <a href="dashboard.php">Dashboard</a>
        <a href="fakultas/index.php">Fakultas</a>
        <a href="prodi/index.php">Prodi</a>
        <a href="mahasiswa/index.php">Mahasiswa</a>
        <a href="dosen/index.php">Dosen</a>
        <a href="matakuliah/index.php">Mata Kuliah</a>
        <a href="jadwal/index.php">Jadwal</a>

        <a class="logout mt-3" href="../logout.php">Logout</a>
    </div>

    <!-- CONTENT -->
    <div class="content flex-grow-1 p-4">

        <h3 class="mb-3">Dashboard Admin</h3>
        <p>Selamat datang di sistem akademik.</p>

        <div class="row g-4 mt-3">

            <div class="col-md-4">
                <div class="card shadow-sm text-center p-4">
                    Fakultas
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm text-center p-4">
                    Program Studi
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm text-center p-4">
                    Mahasiswa
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm text-center p-4">
                    Dosen
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm text-center p-4">
                    Mata Kuliah
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm text-center p-4">
                    Jadwal
                </div>
            </div>

        </div>

    </div>

</div>

</body>
</html>
