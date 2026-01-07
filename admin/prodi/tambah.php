<?php
include "../../koneksi.php";
$fakultas = mysqli_query($conn,"SELECT * FROM tbfakultas");
?>

<form method="POST" action="simpan.php" class="p-4">
<select name="id_fakultas" class="form-control mb-2" required>
<option value="">Pilih Fakultas</option>
<?php while($f=mysqli_fetch_assoc($fakultas)): ?>
<option value="<?= $f['id_fakultas'] ?>"><?= $f['nama_fakultas'] ?></option>
<?php endwhile; ?>
</select>

<input type="text" name="nama_prodi" class="form-control mb-2" placeholder="Nama Prodi" required>
<button class="btn btn-success">Simpan</button>
</form>
