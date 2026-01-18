<?php
include "../layout/header.php";
include "../layout/sidebar.php";
include "../../koneksi.php";

$nip = $_GET['id'];

$query = mysqli_query($conn, "
    SELECT *
    FROM view_dosen
    WHERE nip = '$nip'
");

$data = mysqli_fetch_assoc($query);

if (!$data) {
    echo "<script>
        alert('Data dosen tidak ditemukan');
        window.location='index.php';
    </script>";
    exit;
}
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

        <h4 class="mb-4">Detail Dosen</h4>

        <div class="card shadow-sm">
            <div class="card-body">

                <table class="table table-bordered">

                    <tr>
                        <th width="260">NIP</th>
                        <td><?= $data['nip']; ?></td>
                    </tr>

                    <tr>
                        <th>Nama Dosen</th>
                        <td><?= $data['nama_dosen']; ?></td>
                    </tr>

                    <tr>
                        <th>Program Studi</th>
                        <td><?= $data['nama_prodi']; ?></td>
                    </tr>

                    <tr>
                        <th>Tempat Lahir</th>
                        <td><?= $data['tempat_lahir']; ?></td>
                    </tr>

                    <tr>
                        <th>Tanggal Lahir</th>
                        <td><?= $data['tgl_lahir']; ?></td>
                    </tr>

                    <tr>
                        <th>Jenis Kelamin</th>
                        <td>
                            <?= $data['jenis_kelamin'] == 'L'
                                ? 'Laki-laki'
                                : 'Perempuan'; ?>
                        </td>
                    </tr>

                    <tr>
                        <th>Email</th>
                        <td><?= $data['email']; ?></td>
                    </tr>

                    <tr>
                        <th>No Telepon</th>
                        <td><?= $data['no_telp']; ?></td>
                    </tr>

                    <tr>
                        <th>Alamat</th>
                        <td><?= $data['alamat']; ?></td>
                    </tr>

                </table>
                <a href="index.php" class="btn btn-secondary mt-3">
                    ← Kembali
                </a>

            </div>
        </div>

    </div>
</div>

<?php include "../layout/footer.php"; ?>
