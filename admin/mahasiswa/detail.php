<?php
include "../layout/header.php";
include "../layout/sidebar.php";
include "../../koneksi.php";

$nrp = $_GET['id'];

$query = mysqli_query($conn, "
    SELECT * 
    FROM view_mahasiswa 
    WHERE nrp = '$nrp'
");

$data = mysqli_fetch_assoc($query);

if (!$data) {
    echo "<script>
        alert('Data mahasiswa tidak ditemukan');
        window.location='index.php';
    </script>";
    exit;
}
?>

<div class="main">

    <div class="topbar">
        <div class="admin">
            <div class="avatar"></div>
            <span>Admin</span>
        </div>
    </div>

    <div class="content">

        <h4 class="mb-4">Detail Mahasiswa</h4>

        <div class="card shadow-sm">
            <div class="card-body">

                <table class="table table-bordered">

                    <tr>
                        <th width="280">NRP</th>
                        <td><?= $data['nrp']; ?></td>
                    </tr>

                    <tr>
                        <th>Nama Mahasiswa</th>
                        <td><?= $data['nama_mahasiswa']; ?></td>
                    </tr>

                    <tr>
                        <th>Program Studi</th>
                        <td><?= $data['nama_prodi']; ?></td>
                    </tr>

                    <tr>
                        <th>Angkatan</th>
                        <td><?= $data['angkatan']; ?></td>
                    </tr>

                    <tr>
                        <th>Status Mahasiswa</th>
                        <td><?= $data['status_mhs']; ?></td>
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
                            <?= $data['jenis_kelamin'] == 'L' ? 'Laki-laki' : 'Perempuan'; ?>
                        </td>
                    </tr>

                    <tr>
                        <th>Email Mahasiswa</th>
                        <td><?= $data['email']; ?></td>
                    </tr>

                    <tr>
                        <th>No Telp Mahasiswa</th>
                        <td><?= $data['no_telp_mahasiswa']; ?></td>
                    </tr>

                    <tr>
                        <th>Alamat Mahasiswa</th>
                        <td><?= $data['alamat_mahasiswa']; ?></td>
                    </tr>

                    <tr class="table-secondary">
                        <th colspan="2">Data Wali</th>
                    </tr>

                    <tr>
                        <th>Nama Wali</th>
                        <td><?= $data['nama_wali']; ?></td>
                    </tr>

                    <tr>
                        <th>Email Wali</th>
                        <td><?= $data['email_wali']; ?></td>
                    </tr>

                    <tr>
                        <th>No Telp Wali</th>
                        <td><?= $data['no_telp_wali']; ?></td>
                    </tr>

                    <tr>
                        <th>Alamat Wali</th>
                        <td><?= $data['alamat_wali']; ?></td>
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
