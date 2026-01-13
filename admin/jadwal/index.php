<?php
include "../layout/header.php";
include "../layout/sidebar.php";

include "../../koneksi.php";

// Query data jadwal
$data = mysqli_query($conn, "
    SELECT j.*, m.nama_mk, d.nama_dosen
    FROM tbdkbs j
    JOIN tbmatakuliah m ON j.id_mk = m.id_mk
    JOIN tbdosen d ON j.nidn = d.nidn
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

        <h4 class="mb-3">Data Jadwal Kuliah</h4>

        <a href="tambah.php" class="btn btn-primary mb-3">
            + Tambah Jadwal
        </a>

        <div class="card shadow-sm">
            <div class="card-body">

                <table class="table table-bordered table-striped mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Hari</th>
                            <th>Mata Kuliah</th>
                            <th>Dosen</th>
                            <th>Jam</th>
                            <th>Ruang</th>
                            <th width="160">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($data)) : ?>
                        <tr>
                            <td><?= $row['hari']; ?></td>
                            <td><?= $row['nama_mk']; ?></td>
                            <td><?= $row['nama_dosen']; ?></td>
                            <td><?= $row['jam_mulai']; ?> - <?= $row['jam_selesai']; ?></td>
                            <td><?= $row['ruang']; ?></td>
                            <td>
                                <a href="edit.php?id=<?= $row['id_jadwal']; ?>" 
                                   class="btn btn-warning btn-sm">
                                   Edit
                                </a>

                                <a href="hapus.php?id=<?= $row['id_jadwal']; ?>" 
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
