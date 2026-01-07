<?php
include "../../koneksi.php";
$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM tbfakultas WHERE id_fakultas='$id'"));
?>

<form method="POST" action="update.php">
<input type="hidden" name="id" value="<?= $data['id_fakultas'] ?>">
<input type="text" name="nama_fakultas" value="<?= $data['nama_fakultas'] ?>">
<button>Update</button>
</form>
