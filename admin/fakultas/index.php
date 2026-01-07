<?php
session_start();
include "../../koneksi.php";

$data = mysqli_query($conn,"SELECT * FROM tbfakultas");
?>

<h3>Data Fakultas</h3>
<a href="tambah.php">Tambah Fakultas</a>

<table border="1" cellpadding="8">
<tr>
  <th>No</th>
  <th>Nama Fakultas</th>
  <th>Aksi</th>
</tr>

<?php $no=1; while($row=mysqli_fetch_assoc($data)): ?>
<tr>
  <td><?= $no++ ?></td>
  <td><?= $row['nama_fakultas'] ?></td>
  <td>
    <a href="edit.php?id=<?= $row['id_fakultas'] ?>">Edit</a> |
    <a href="hapus.php?id=<?= $row['id_fakultas'] ?>" onclick="return confirm('Hapus data?')">Hapus</a>
  </td>
</tr>
<?php endwhile; ?>
</table>
