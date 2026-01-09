<?php include "../layout/header.php"; ?>
<?php include "../layout/sidebar.php"; ?>

<div class="content">

<?php
session_start();
include "../../koneksi.php";

$data = mysqli_query($conn,"
SELECT m.*, p.nama_prodi
FROM tbmahasiswa m
JOIN tbprodi p ON m.id_prodi = p.id_prodi
");
?>

<!DOCTYPE html>
<html>
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">

<h4>Data Mahasiswa</h4>
<a href="tambah.php" class="btn btn-primary mb-3">Tambah Mahasiswa</a>

<table class="table table-bordered table-striped">
<tr>
<th>NRP</th><th>Nama Mahasiswa</th><th>Prodi</th><th>Angkatan</th><th>Aksi</th>
</tr>

<?php while($row=mysqli_fetch_assoc($data)): ?>
<tr>
<td><?= $row['nrp'] ?></td>
<td><?= $row['nama_mahasiswa'] ?></td>
<td><?= $row['nama_prodi'] ?></td>
<td><?= $row['angkatan'] ?></td>
<td>
<a class="btn btn-warning btn-sm" href="edit.php?id=<?= $row['nrp'] ?>">Edit</a>
<a class="btn btn-danger btn-sm" href="hapus.php?id=<?= $row['nrp'] ?>" onclick="return confirm('Hapus?')">Hapus</a>
</td>
</tr>
<?php endwhile; ?>

</table>
</body>
</html>

<?php include "../layout/footer.php"; ?>
