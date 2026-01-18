<?php
include "../layout/header.php";
include "../layout/sidebar.php";
include "../../koneksi.php";

$data = mysqli_query($conn, "SELECT * FROM tbfakultas ORDER BY id_fakultas ASC");
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

        <h4 class="mb-3">Data Fakultas</h4>

        <a href="tambah.php" class="btn btn-primary mb-3">
            + Tambah Fakultas
        </a>

        <div class="card shadow-sm">
            <div class="card-body">

                <table class="table table-bordered table-striped mb-0">
                    <thead class="table-light">
                        <tr>
                            <th width="60">No</th>
                            <th width="140">ID Fakultas</th>
                            <th>Nama Fakultas</th>
                            <th width="180">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $no = 1; ?>
                        <?php while ($row = mysqli_fetch_assoc($data)) : ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td>
                                <?= $row['id_fakultas']; ?>

                            </td>
                            <td><?= $row['nama_fakultas']; ?></td>
                            <td>
                                <a href="edit.php?id=<?= $row['id_fakultas']; ?>"
                                   class="btn btn-warning btn-sm">
                                   Edit
                                </a>

                                <a href="hapus.php?id=<?= $row['id_fakultas']; ?>"
                                   class="btn btn-danger btn-sm"
                                   onclick="return confirm('Yakin ingin menghapus fakultas ini?')">
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
