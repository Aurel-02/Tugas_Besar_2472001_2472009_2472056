<?php
include "../layout/header.php";
include "../layout/sidebar.php";
include "../../koneksi.php";

// Query data mahasiswa dari VIEW
$data = mysqli_query($conn, "
    SELECT * FROM view_mahasiswa
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

        <h4 class="mb-3">Data Mahasiswa</h4>

        <a href="tambah.php" class="btn btn-primary mb-3">
            + Tambah Mahasiswa
        </a>

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

                                <!-- tombol detail -->
                                <a href="detail.php?id=<?= $row['nrp']; ?>" 
                                   class="btn btn-info btn-sm">
                                   Detail
                                </a>

                                <!-- tombol edit -->
                                <a href="edit.php?id=<?= $row['nrp']; ?>" 
                                   class="btn btn-warning btn-sm">
                                   Edit
                                </a>

                                <!-- tombol hapus -->
                                <a href="hapus.php?id=<?= $row['nrp']; ?>" 
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
