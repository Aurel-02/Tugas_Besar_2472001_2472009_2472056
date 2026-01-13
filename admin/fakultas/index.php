<?php
session_start();
include "../../koneksi.php";
include "../layout/header.php";
include "../layout/sidebar.php";

$data = mysqli_query($conn, "SELECT * FROM tbfakultas ORDER BY id_fakultas ASC");
?>

<div class="main">
    <!-- TOPBAR -->
    <div class="topbar">
        <h6>Data Fakultas</h6>
        <div class="user">
            <span><?= $_SESSION['nama']; ?></span>
            <div class="avatar"></div>
            <a href="../../logout.php" class="logout-link">Logout</a>
        </div>
    </div>

    <!-- CONTENT -->
    <div class="content">

        <div class="card shadow-sm p-3">

            <div class="d-flex justify-content-between mb-3">
                <h5>Data Fakultas</h5>
                <a href="tambah.php" class="btn btn-primary btn-sm">
                    + Tambah Fakultas
                </a>
            </div>

            <table class="table table-bordered table-sm align-middle">
                <thead class="table-light">
                    <tr>
                        <th width="50">No</th>
                        <th width="120">ID Fakultas</th>
                        <th>Nama Fakultas</th>
                        <th width="120">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php $no=1; while($row=mysqli_fetch_assoc($data)): ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $row['kode_fakultas']; ?></td>
                        <td><?= $row['nama_fakultas']; ?></td>
                        <td>
                            <a href="edit.php?id=<?= $row['id_fakultas']; ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="hapus.php?id=<?= $row['id_fakultas']; ?>" 
                               class="btn btn-danger btn-sm"
                               onclick="return confirm('Yakin hapus data?')">
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
