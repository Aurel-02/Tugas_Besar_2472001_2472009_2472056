<?php include "../layout/header.php"; ?>
<?php include "../layout/sidebar.php"; ?>

<div class="content">

<?php
session_start();
include "../../koneksi.php";

$data = mysqli_query($conn,"
SELECT j.*, m.nama_mk, d.nama_dosen
FROM tbjadwal j
JOIN tbmatakuliah m ON j.id_mk = m.id_mk
JOIN tbdosen d ON j.nidn = d.nidn
");
?>

<!DOCTYPE html>
<html>
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">

<h4>Data Jadwal Kuliah</h4>
<a href="tambah.php" class="btn btn-primary mb-3">Tambah Jadwal</a>

<table class="table table-bordered table-striped">
<tr>
<th>Hari</th><th>Mata Kuliah</th><th>Dosen</th><th>Jam</th><th>Ruang</th><th>Aksi</th>
</tr>

<?php while($row=mysqli_fetch_assoc($data)): ?>
<tr>
<td><?= $row['hari'] ?></td>
<td><?= $row['nama_mk'] ?></td>
<td><?= $row['nama_dosen'] ?></td>
<td><?= $row['jam_mulai'] ?> - <?= $row['jam_selesai'] ?></td>
<td><?= $row['ruang'] ?></td>
<td>
<a class="btn btn-warning btn-sm" href="edit.php?id=<?= $row['id_jadwal'] ?>">Edit</a>
<a class="btn btn-danger btn-sm" href="hapus.php?id=<?= $row['id_jadwal'] ?>" onclick="return confirm('Hapus?')">Hapus</a>
</td>
</tr>
<?php endwhile; ?>

</table>
</body>
</html>

<?php include "../layout/footer.php"; ?>
