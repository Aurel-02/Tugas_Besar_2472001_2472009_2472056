<?php
include "../layout/header.php";
include "../layout/sidebar.php";

include "../../koneksi.php";

// Query data dosen + prodi
$data = mysqli_query($conn, "
    SELECT d.*, p.nama_prodi
    FROM tbdosen d
    JOIN tbprodi p ON d.id_prodi = p.id_prodi
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

        <h4 class="mb-3">Data Dosen</h4>

        <a href="tambah.php" class="btn btn-primary mb-3">
            + Tambah Dosen
        </a>

        <div class="card shadow-sm">
            <div class="card-body">

                <table class="table table-bordered table-striped mb-0">
                    <thead class="table-light">
                        <tr>
                            <th width="120">NIDN</th>
                            <th>Nama Dosen</th>
                            <th>Program Studi</th>
                            <th width="180">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($data)) : ?>
                        <tr>
                            <td><?= $row['nidn']; ?></td>
                            <td><?= $row['nama_dosen']; ?></td>
                            <td><?= $row['nama_prodi']; ?></td>
                            <td>
                                <a href="edit.php?id=<?= $row['nidn']; ?>" 
                                   class="btn btn-warning btn-sm">
                                   Edit
                                </a>

                                <a href="hapus.php?id=<?= $row['nidn']; ?>" 
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

    </div> <!-- content -->

<?php include "../layout/footer.php"; ?>
