<?php include "../../koneksi.php";
$mk=mysqli_query($conn,"SELECT * FROM tbmatakuliah");
$dosen=mysqli_query($conn,"SELECT * FROM tbdosen"); ?>
<form method="POST" action="simpan.php" class="p-4">
<select class="form-control mb-2" name="id_mk">
<?php while($m=mysqli_fetch_assoc($mk)): ?>
<option value="<?= $m['id_mk'] ?>"><?= $m['nama_mk'] ?></option>
<?php endwhile; ?>
</select>

<select class="form-control mb-2" name="nidn">
<?php while($d=mysqli_fetch_assoc($dosen)): ?>
<option value="<?= $d['nidn'] ?>"><?= $d['nama_dosen'] ?></option>
<?php endwhile; ?>
</select>

<input class="form-control mb-2" name="hari" placeholder="Hari">
<input class="form-control mb-2" type="time" name="jam_mulai">
<input class="form-control mb-2" type="time" name="jam_selesai">
<input class="form-control mb-2" name="ruang" placeholder="Ruang">
<button class="btn btn-success">Simpan</button>
</form>
