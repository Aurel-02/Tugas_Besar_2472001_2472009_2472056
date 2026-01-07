<?php include "../../koneksi.php";
$prodi=mysqli_query($conn,"SELECT * FROM tbprodi"); ?>
<form method="POST" action="simpan.php" class="p-4">
<select class="form-control mb-2" name="id_prodi">
<?php while($p=mysqli_fetch_assoc($prodi)): ?>
<option value="<?= $p['id_prodi'] ?>"><?= $p['nama_prodi'] ?></option>
<?php endwhile; ?>
</select>
<input class="form-control mb-2" name="nama_mk" placeholder="Nama Mata Kuliah">
<input class="form-control mb-2" name="sks" type="number" placeholder="SKS">
<button class="btn btn-success">Simpan</button>
</form>
