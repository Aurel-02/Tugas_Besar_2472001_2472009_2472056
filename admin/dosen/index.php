<?php
include "../layout/header.php";
include "../layout/sidebar.php";
include "../../koneksi.php";

$data = mysqli_query($conn, "
    SELECT * FROM view_dosen
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

                                <a href="detail.php?id=<?= $row['nip']; ?>"
                                   class="btn btn-info btn-sm">
                                   Detail
                                </a>

                                <a href="edit.php?id=<?= $row['nip']; ?>"
                                   class="btn btn-warning btn-sm">
                                   Edit
                                </a>

                                <a href="hapus.php?id=<?= $row['nip']; ?>"
                                    onclick="return confirm('Yakin ingin menghapus data dosen ini?')"
                                    class="btn btn-danger btn-sm">
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
