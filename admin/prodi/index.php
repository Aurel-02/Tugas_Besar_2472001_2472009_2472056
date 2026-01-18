<?php
include "../layout/header.php";
include "../layout/sidebar.php";
include "../../koneksi.php";

// Query data prodi + fakultas
$data = mysqli_query($conn, "
    SELECT p.*, f.nama_fakultas
    FROM tbprodi p
    JOIN tbfakultas f ON p.id_fakultas = f.id_fakultas
    ORDER BY p.id_prodi ASC
");
?>

<div class="main">

<!-- Topbar -->
<div class="topbar">
    <div class="admin">
        <div class="avatar"></div>
        <span>Admin</span>
    </div>
</div>

<!-- Content -->
<div class="content">

<h4 class="mb-3">Data Program Studi</h4>

<a href="tambah.php" class="btn btn-primary mb-3">
    + Tambah Prodi
</a>

<div class="card shadow-sm">
<div class="card-body">

<table class="table table-bordered table-striped mb-0">
<thead class="table-light">
<tr>
    <th width="60">No</th>
    <th width="100">ID Prodi</th>
    <th>Nama Program Studi</th>
    <th>Fakultas</th>
    <th width="180">Aksi</th>
</tr>
</thead>

<tbody>
<?php $no = 1; while ($row = mysqli_fetch_assoc($data)) : ?>
<tr>
    <td><?= $no++; ?></td>
    <td><?= $row['id_prodi']; ?></td>
    <td><?= $row['nama_prodi']; ?></td>
    <td><?= $row['nama_fakultas']; ?></td>
    <td>
        <a href="edit.php?id=<?= $row['id_prodi']; ?>" 
           class="btn btn-warning btn-sm">
           Edit
        </a>

        <a href="hapus.php?id=<?= $row['id_prodi']; ?>" 
           class="btn btn-danger btn-sm"
           onclick="return confirm('Yakin ingin menghapus?')">
           Hapus
        </a>
    </td>
</tr>
<?php endwhile; ?>
</tbody>
</table>

</div>
</div>

</div>

<?php include "../layout/footer.php"; ?>
