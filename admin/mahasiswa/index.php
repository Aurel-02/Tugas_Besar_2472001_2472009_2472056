<?php
include "../layout/header.php";
include "../layout/sidebar.php";
include "../../koneksi.php";

$allowed_sort = [
    'nrp',
    'nama_mahasiswa',
    'nama_prodi',
    'angkatan'
];

$sort  = $_GET['sort']  ?? 'nrp';
$order = $_GET['order'] ?? 'ASC';

if (!in_array($sort, $allowed_sort)) {
    $sort = 'nrp';
}

$order = strtoupper($order) === 'DESC' ? 'DESC' : 'ASC';

$data = mysqli_query($conn, "
    SELECT * FROM view_mahasiswa
    ORDER BY $sort $order
");
?>

<div class="main">

<div class="topbar">
    <div class="admin">
        <div class="avatar"></div>
        <span>Admin</span>
    </div>
</div>

<div class="content">

<h4 class="mb-3">Data Mahasiswa</h4>

<a href="tambah.php" class="btn btn-primary mb-3">
    + Tambah Mahasiswa
</a>

<form method="GET" class="row g-2 mb-3">
    <div class="col-md-3">
        <select name="sort" class="form-select">
            <option value="">-- Urutkan Berdasarkan --</option>
            <option value="angkatan">Tahun Angkatan</option>
            <option value="nrp">NRP</option>
            <option value="nama_mahasiswa">Nama Mahasiswa</option>
            <option value="nama_prodi">Program Studi</option>
        </select>
    </div>

    <div class="col-md-2">
        <select name="order" class="form-select">
            <option value="ASC">ASC↑</option>
            <option value="DESC">DSC↓</option>
        </select>
    </div>

    <div class="col-md-2">
        <button type="submit" class="btn btn-secondary w-100">
            Urutkan
        </button>
    </div>
</form>

<div class="card shadow-sm">
<div class="card-body">

<table class="table table-bordered table-striped mb-0">
<thead class="table-light">
<tr>
    <th width="140">NRP</th>
    <th>Nama Mahasiswa</th>
    <th>Program Studi</th>
    <th width="120">Angkatan</th>
    <th width="220">Aksi</th>
</tr>
</thead>

<tbody>
<?php while ($row = mysqli_fetch_assoc($data)) : ?>
<tr>
    <td><?= $row['nrp']; ?></td>
    <td><?= $row['nama_mahasiswa']; ?></td>
    <td><?= $row['nama_prodi']; ?></td>
    <td><?= $row['angkatan']; ?></td>
    <td>
        <a href="detail.php?id=<?= $row['nrp']; ?>" class="btn btn-info btn-sm">Detail</a>
        <a href="edit.php?id=<?= $row['nrp']; ?>" class="btn btn-warning btn-sm">Edit</a>
        <a href="hapus.php?id=<?= $row['nrp']; ?>" class="btn btn-danger btn-sm"
           onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
    </td>
</tr>
<?php endwhile; ?>
</tbody>
</table>

</div>
</div>

</div>

<?php include "../layout/footer.php"; ?>
