<?php
include "../../koneksi.php";
$id=$_GET['id'];
$data=mysqli_query($conn,"SELECT * FROM tbdosen WHERE nidn='$id'");
$row=mysqli_fetch_assoc($data);
?>

<form method="POST" action="update.php">
<input type="hidden" name="nidn" value="<?= $row['nidn'] ?>">

<label>Nama Dosen</label>
<input class="form-control mb-2" name="nama" value="<?= $row['nama_dosen'] ?>">

<button class="btn btn-primary">Update</button>
</form>
