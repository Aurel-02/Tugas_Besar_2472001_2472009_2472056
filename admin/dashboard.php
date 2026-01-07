<?php
session_start();
if(!isset($_SESSION['login']) || $_SESSION['role_id'] != 1){
    header("Location: ../index.php");
    exit;
}
?>

<h2>Dashboard Admin</h2>
<p>Selamat datang, <?= $_SESSION['nama'] ?></p>

<ul>
  <li><a href="../admin/fakultas/index.php">Data Fakultas</a></li>
  <li><a href="../admin/prodi/index.php">Data Prodi</a></li>
  <li><a href="../admin/mahasiswa/index.php">Data Mahasiswa</a></li>
  <li><a href="../admin/dosen/index.php">Data Dosen</a></li>
  <li><a href="../admin/matakuliah/index.php">Data Mata Kuliah</a></li>
  <li><a href="../admin/jadwal/index.php">Jadwal</a></li>
</ul>

<a href="../logout.php">Logout</a>
