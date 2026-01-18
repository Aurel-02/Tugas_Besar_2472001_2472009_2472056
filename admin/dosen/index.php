<?php
include "../layout/header.php";
include "../layout/sidebar.php";
include "../../koneksi.php";

// ambil data dari VIEW
$data = mysqli_query($conn, "
    SELECT * FROM view_dosen
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

    <div class="content">

        <h4 class="mb-3">Data Dosen</h4>

        <a href="tambah.php" class="btn btn-primary mb-3">
            + Tambah Dosen
        </a>

        <div class="card shadow-sm">
            <div class="card-body">

                <table class="table table-bordered table-striped mb-0">
                    <thead class="table-light">
                        <tr>
                            <th width="120">NIP</th>
                            <th>Nama Dosen</th>
                            <th>Program Studi</th>
                            <th width="220">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php while ($row = mysqli_fetch_assoc($data)) : ?>
                        <tr>
                            <td><?= $row['nip']; ?></td>
                            <td><?= $row['nama_dosen']; ?></td>
                            <td><?= $row['nama_prodi']; ?></td>
                            <td>

                                <!-- DETAIL -->
                                <a href="detail.php?id=<?= $row['nip']; ?>"
                                   class="btn btn-info btn-sm">
                                   Detail
                                </a>

                                <!-- EDIT -->
                                <a href="edit.php?id=<?= $row['nip']; ?>"
                                   class="btn btn-warning btn-sm">
                                   Edit
                                </a>

                                <!-- HAPUS -->
                                <a href="hapus.php?id=<?= $row['nip']; ?>"
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
