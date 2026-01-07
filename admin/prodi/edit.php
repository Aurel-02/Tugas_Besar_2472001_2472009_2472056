<?php
include "../../koneksi.php";
$id = $_GET['id'];
$data = mysqli_query($conn,"SELECT * FROM tbprodi WHERE id_prodi='$id'");
$row = mysqli_fetch_assoc($data);
?>

<form method="POST" action="update.php">
<input type="hidden" name="id" value="<?= $row['id_prodi'] ?>">

<label>Nama Prodi</label>
<input class="form-control mb-2" name="nama" value="<?= $row['nama_prodi'] ?>">

<button class="btn btn-primary">Update</button>
</form>
