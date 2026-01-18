<?php
include "../layout/header.php";
include "../layout/sidebar.php";
include "../../koneksi.php";

$filterHari = "";

if (isset($_GET['hari']) && $_GET['hari'] != "") {
    $hari = mysqli_real_escape_string($conn, $_GET['hari']);
    $filterHari = "WHERE p.hari = '$hari'";
}

$data = mysqli_query($conn, "
    SELECT p.*, m.nama_mk, d.nama_dosen
    FROM tbperwalian p
    JOIN tbmatakuliah m ON p.id_mk = m.id_mk
    JOIN tbdosen d ON p.nip = d.nip
    $filterHari
    ORDER BY FIELD(
        p.hari,
        'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'
    ), p.jam_mulai ASC
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

        <h4 class="mb-3">Data Jadwal</h4>

        <div class="d-flex justify-content-between mb-3">

            <a href="tambah.php" class="btn btn-primary">
                + Tambah Jadwal
            </a>

            <form method="GET" class="d-flex gap-2">
                <select name="hari" class="form-select">
                    <option value="">-- Semua Hari --</option>
                    <option value="Senin"  <?= (@$_GET['hari']=="Senin")  ? "selected":""; ?>>Senin</option>
                    <option value="Selasa" <?= (@$_GET['hari']=="Selasa") ? "selected":""; ?>>Selasa</option>
                    <option value="Rabu"   <?= (@$_GET['hari']=="Rabu")   ? "selected":""; ?>>Rabu</option>
                    <option value="Kamis"  <?= (@$_GET['hari']=="Kamis")  ? "selected":""; ?>>Kamis</option>
                    <option value="Jumat"  <?= (@$_GET['hari']=="Jumat")  ? "selected":""; ?>>Jumat</option>
                    <option value="Sabtu"  <?= (@$_GET['hari']=="Sabtu")  ? "selected":""; ?>>Sabtu</option>
                </select>

                <button type="submit" class="btn btn-secondary">
                    Sort
                </button>

                <?php if (!empty($_GET['hari'])) : ?>
                    <a href="index.php" class="btn btn-outline-secondary">
                        Reset
                    </a>
                <?php endif; ?>
            </form>

        </div>

        <div class="card shadow-sm">
            <div class="card-body">

                <table class="table table-bordered table-striped mb-0">
                    <thead class="table-light">
                        <tr>
                            <th width="110">Hari</th>
                            <th>Mata Kuliah</th>
                            <th>Dosen</th>
                            <th width="160">Jam</th>
                            <th width="120">Ruang</th>
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
                                <a href="edit.php?id=<?= $row['id_perwalian']; ?>"
                                   class="btn btn-warning btn-sm">
                                   Edit
                                </a>

                                <a href="hapus.php?id=<?= $row['id_perwalian']; ?>"
                                   class="btn btn-danger btn-sm"
                                   onclick="return confirm('Yakin ingin menghapus?')">
                                   Hapus
                                </a>
                            </td>
                        </tr>
                        <?php endwhile; ?>

                        <?php if (mysqli_num_rows($data) == 0) : ?>
                        <tr>
                            <td colspan="6" class="text-center text-muted">
                                Data tidak ditemukan
                            </td>
                        </tr>
                        <?php endif; ?>

                    </tbody>
                </table>

            </div>
        </div>

    </div>

<?php include "../layout/footer.php"; ?>
