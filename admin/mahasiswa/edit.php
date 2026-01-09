<?php include "../layout/header.php"; ?>
<?php include "../layout/sidebar.php"; ?>

<div class="content">

<?php
include "../../koneksi.php";
$id=$_GET['id'];
$data=mysqli_query($conn,"SELECT * FROM tbmahasiswa WHERE nrp='$id'");
$row=mysqli_fetch_assoc($data);
?>

<form method="POST" action="update.php">
<input type="hidden" name="nrp" value="<?= $row['nrp'] ?>">

<label>Nama Mahasiswa</label>
<input class="form-control mb-2" name="nama" value="<?= $row['nama_mahasiswa'] ?>">

<button class="btn btn-primary">Update</button>
</form>
