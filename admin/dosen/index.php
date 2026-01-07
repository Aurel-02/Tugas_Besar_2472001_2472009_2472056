<?php
session_start();
include "../../koneksi.php";

$data = mysqli_query($conn,"
SELECT d.*, p.nama_prodi
FROM tbdosen d
JOIN tbprodi p ON d.id_prodi = p.id_prodi
");
?>

<!DOCTYPE html>
<html>
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">

<h4>Data Dosen</h4>
<a href="tambah.php" class="btn btn-primary mb-3">Tambah Dosen</a>

<table class="table table-bordered table-striped">
<tr>
<th>NIDN</th><th>Nama Dosen</th><th>Prodi</th><th>Aksi</th>
</tr>

<?php while($row=mysqli_fetch_assoc($data)): ?>
<tr>
<td><?= $row['nidn'] ?></td>
<td><?= $row['nama_dosen'] ?></td>
<td><?= $row['nama_prodi'] ?></td>
<td>
<a class="btn btn-warning btn-sm" href="edit.php?id=<?= $row['nidn'] ?>">Edit</a>
<a class="btn btn-danger btn-sm" href="hapus.php?id=<?= $row['nidn'] ?>" onclick="return confirm('Hapus?')">Hapus</a>
</td>
</tr>
<?php endwhile; ?>

</table>
</body>
</html>
