<?php include "../layout/header.php"; ?>
<?php include "../layout/sidebar.php"; ?>

<div class="content">

<?php
session_start();
include "../../koneksi.php";

$data = mysqli_query($conn,"SELECT * FROM tbfakultas");
?>

<!DOCTYPE html>
<html>
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">

<h4>Data Fakultas</h4>
<a href="tambah.php" class="btn btn-primary mb-3">Tambah Fakultas</a>

<table class="table table-bordered table-striped">
<tr>
<th>No</th><th>Nama Fakultas</th><th>Aksi</th>
</tr>

<?php $no=1; while($row=mysqli_fetch_assoc($data)): ?>
<tr>
<td><?= $no++ ?></td>
<td><?= $row['nama_fakultas'] ?></td>
<td>
<a class="btn btn-warning btn-sm" href="edit.php?id=<?= $row['id_fakultas'] ?>">Edit</a>
<a class="btn btn-danger btn-sm" href="hapus.php?id=<?= $row['id_fakultas'] ?>" onclick="return confirm('Hapus?')">Hapus</a>
</td>
</tr>
<?php endwhile; ?>

</table>
</body>
</html>

<?php include "../layout/footer.php"; ?>
