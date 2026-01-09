<?php include "../layout/header.php"; ?>
<?php include "../layout/sidebar.php"; ?>

<div class="content">

<?php
session_start();
include "../../koneksi.php";

$data = mysqli_query($conn,"
SELECT m.*, p.nama_prodi
FROM tbmatakuliah m
LEFT JOIN tbprodi p ON m.id_prodi = p.id_prodi
");
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Data Mata Kuliah</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">

<h4>Data Mata Kuliah</h4>
<a href="tambah.php" class="btn btn-primary mb-3">Tambah Mata Kuliah</a>

<table class="table table-bordered table-striped">
<tr>
<th>Kode MK</th>
<th>Nama Mata Kuliah</th>
<th>SKS</th>
<th>Program Studi</th>
<th>Aksi</th>
</tr>

<?php while($row = mysqli_fetch_assoc($data)): ?>
<tr>
<td><?= $row['id_mk'] ?></td>
<td><?= $row['nama_mk'] ?></td>
<td><?= $row['sks'] ?></td>
<td><?= $row['nama_prodi'] ?? '-' ?></td>
<td>
<a class="btn btn-warning btn-sm" href="edit.php?id=<?= $row['id_mk'] ?>">Edit</a>
<a class="btn btn-danger btn-sm" href="hapus.php?id=<?= $row['id_mk'] ?>" onclick="return confirm('Hapus?')">Hapus</a>
</td>
</tr>
<?php endwhile; ?>

</table>

</body>
</html>

<?php include "../layout/footer.php"; ?>
