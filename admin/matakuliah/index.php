<?php
include "../layout/header.php";
include "../layout/sidebar.php";

include "../../koneksi.php";

$data = mysqli_query($conn, "
    SELECT m.*, p.nama_prodi
    FROM tbmatakuliah m
    LEFT JOIN tbprodi p ON m.id_prodi = p.id_prodi
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

        <h4 class="mb-3">Data Mata Kuliah</h4>

        <a href="tambah.php" class="btn btn-primary mb-3">
            + Tambah Mata Kuliah
        </a>

        <div class="card shadow-sm">
            <div class="card-body">

                <table class="table table-bordered table-striped mb-0">
                    <thead class="table-light">
                        <tr>
                            <th width="140">Kode MK</th>
                            <th>Nama Mata Kuliah</th>
                            <th width="80">SKS</th>
                            <th>Program Studi</th>
                            <th width="180">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($data)) : ?>
                        <tr>
                            <td><?= $row['id_mk']; ?></td>
                            <td><?= $row['nama_mk']; ?></td>
                            <td><?= $row['sks']; ?></td>
                            <td><?= $row['nama_prodi'] ?? '-'; ?></td>
                            <td>
                                <a href="edit.php?id=<?= $row['id_mk']; ?>" 
                                   class="btn btn-warning btn-sm">
                                   Edit
                                </a>

                                <a href="hapus.php?id=<?= $row['id_mk']; ?>" 
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
