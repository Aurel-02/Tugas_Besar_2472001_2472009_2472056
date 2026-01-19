<?php
session_start();
if (!isset($_SESSION['login']) || $_SESSION['role_id'] !== '3') {
    header("Location: /TUGAS_BESAR_2472001_2472009_2472056/login.php?role=3");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Profil Mahasiswa</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/sidebar.css">
    <link rel="stylesheet" href="../css/profile.css">
</head>
<body>
<?php

include __DIR__ . "/../koneksi.php";

$sql = "
    SELECT 
        m.nama_mahasiswa, 
        m.nrp, 
        m.email AS email_mahasiswa, 
        m.angkatan, 
        m.tgl_lahir, 
        m.tempat_lahir, 
        m.jenis_kelamin, 
        m.no_telp_mahasiswa, 
        m.status_mhs,
        m.alamat_mahasiswa,
        m.nama_wali,
        m.email_wali,
        m.no_telp_wali,
        m.alamat_wali,
        p.nama_prodi, 
        d.nama_dosen, 
        d.email AS email_dosen, 
        d.no_telp
    FROM 
        tbmahasiswa m
    INNER JOIN 
        tbdosen d ON m.id_dosen_wali = d.nip
    INNER JOIN
        tbprodi p ON m.id_prodi = p.id_prodi
    WHERE 
        m.nrp = ?"; 


$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Error preparing statement: " . mysqli_error($conn));
}

$stmt->bind_param("s", $_SESSION['user_id']); 

if (!$stmt->execute()) {
    die("Error executing query: " . mysqli_error($conn));
}

$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    
    $nama_mahasiswa = $row['nama_mahasiswa'] ?? 'Tidak ada data';
    $nrp = $row['nrp'] ?? 'Tidak ada data';
    $email = $row['email_mahasiswa'] ?? 'Tidak ada data';
    $angkatan = $row['angkatan'] ?? 'Tidak ada data';
    $tgl_lahir = $row['tgl_lahir'] ?? 'Tidak ada data';
    $tempat_lahir = $row['tempat_lahir'] ?? 'Tidak ada data';
    $jenis_kelamin = $row['jenis_kelamin'] ?? 'Tidak ada data';
    $no_telp_mahasiswa = $row['no_telp_mahasiswa'] ?? 'Tidak ada data';
    $status_mhs = $row['status_mhs'] ?? 'Tidak ada data';
    $alamat_mahasiswa = $row['alamat_mahasiswa'] ?? 'Tidak ada data';
    $nama_wali = $row['nama_wali'] ?? 'Tidak ada data';
    $alamat_wali = $row['alamat_wali'] ?? 'Tidak ada data';
    $no_telp_wali = $row['no_telp_wali'] ?? 'Tidak ada data';
    $email_wali = $row['email_wali'] ?? 'Tidak ada data';
    $nama_prodi = $row['nama_prodi'] ?? 'Tidak ada data';

    $nama_dosen = $row['nama_dosen'] ?? 'Tidak ada data';
    $email_dosen = $row['email_dosen'] ?? 'Tidak ada data';
    $no_telp_dosen = $row['no_telp'] ?? 'Tidak ada data';
} else {
    echo "Tidak ada data";
}

if ($jenis_kelamin === 'L') {
    $jenis_kelamin_text = 'Laki-laki';
} elseif ($jenis_kelamin === 'P') {
    $jenis_kelamin_text = 'Perempuan';
} else {
    $jenis_kelamin_text = 'Tidak ada data';
}

$stmt->close();
$conn->close();
?>

<div class="layout">

    <?php include __DIR__ . '/include/sidebar.php'; ?>

    <div class="main-content">
        <div class="container mt-3">
            <div class="row">
                <div class="col-12 mx-auto" style="max-width: 1700px">
                    <div class="profile-header text-center p-4 bg-white rounded shadow">

                        <div class="avatar-big mb-2">
                            <img src="../img/profile_icon.png" alt="Profile Image">
                        </div>

                        <h2 class="mb-1"><?= $nama_mahasiswa ?></h2>
                        <p class="mb-0"><?= $nrp ?></p>
                        <p class="mb-0"><?= $email ?></p>
                    </div>

                    <div class="profile-details mt-4">
                        <div class="profile-card bg-white p-4 rounded shadow">
                            <div class="row">
                                <div class="col-6">
                                    <label>Nama Lengkap</label>
                                    <p><?= $nama_mahasiswa ?></p>
                                </div>
                                <div class="col-6">
                                    <label>Fakultas</label>
                                    <p>Teknologi dan Rekayasa Cerdas</p>
                                </div>
                                <div class="col-6">
                                    <label>NRP</label>
                                    <p><?= $nrp ?></p>
                                </div>
                                <div class="col-6">
                                    <label>Prodi</label>
                                    <p><?= $nama_prodi ?></p>
                                </div>
                                <div class="col-6">
                                    <label>Tanggal Lahir</label>
                                    <p><?= $tgl_lahir ?></p>
                                </div>
                                <div class="col-6">
                                    <label>Status</label>
                                    <p><?= $status_mhs ?></p>
                                </div>
                                <div class="col-6">
                                    <label>Tempat Lahir</label>
                                    <p><?= $tempat_lahir ?></p>
                                </div>
                                <div class="col-6">
                                    <label>Handphone</label>
                                    <p><?= $no_telp_mahasiswa ?></p>
                                </div>
                                <div class="col-6">
                                    <label>Jenis Kelamin</label>
                                    <p><?= $jenis_kelamin_text ?></p>
                                </div>
                                <div class="col-6">
                                    <label>Angkatan</label>
                                    <p><?= $angkatan ?></p>
                                </div>
                                <div class="col-6">
                                    <label>Alamat Mahasiswa</label>
                                    <p><?= $alamat_mahasiswa ?></p>
                                </div>
                            </div>

                            <hr>

                            <div class="row">
                                <div class="col-6">
                                    <label>Nama Dosen Wali</label>
                                    <p><?= $nama_dosen ?></p>
                                </div>
                                <div class="col-6">
                                    <label>Handphone Dosen Wali</label>
                                    <p><?= $no_telp_dosen ?></p>
                                </div>
                                <div class="col-6">
                                    <label>Email Dosen Wali</label>
                                    <p><?= $email_dosen ?></p>
                                </div>
                            </div>

                            <hr>

                            <div class="row">
                                <div class="col-6">
                                    <label>Nama Wali</label>
                                    <p><?= $nama_wali ?></p>
                                </div>
                                <div class="col-6">
                                    <label>Handphone Wali</label>
                                    <p><?= $no_telp_wali ?></p>
                                </div>
                                <div class="col-6">
                                    <label>Email Wali</label>
                                    <p><?= $email_wali ?></p>
                                </div>
                                <div class="col-6">
                                    <label>Alamat Wali</label>
                                    <p><?= $alamat_wali ?></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 text-end mb-5">
                        <a href="#" class="edit-link"
                            data-bs-toggle="modal"
                            data-bs-target="#editProfileModal">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="#0a2a66">
                                <path d="M12 20h9"/>
                                <path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4Z"/>
                            </svg>
                            Edit Profile
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editProfileModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">

        <div class="modal-header" style="background:#0a2a66;color:white">
            <h5 class="modal-title">Edit Data Diri</h5>
            <button type="button" class="btn-close btn-close-white"
                    data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">
            <form action="update_data.php" method="POST">


                <input type="hidden" name="nrp" value="<?= $nrp ?>">

                <div class="mb-3">
                    <label>Nama Lengkap Mahasiswa</label>
                    <input type="text" class="form-control" value="<?= $nama_mahasiswa ?>" disabled>
                </div>

                <div class="mb-3">
                    <label>NRP</label>
                    <input type="text" class="form-control" value="<?= $nrp ?>" disabled>
                </div>

                <div class="mb-3">
                    <label>Program Studi</label>
                    <input type="text" class="form-control" value="<?= $nama_prodi ?>" disabled>
                </div>

                <div class="mb-3">
                    <label>Angkatan</label>
                    <input type="text" class="form-control" value="<?= $angkatan ?>" disabled>
                </div>

                <hr>

                <div class="mb-3">
                    <label>Tanggal Lahir</label>
                    <input type="date" class="form-control" name="tgl_lahir" value="<?= $tgl_lahir ?>">
                </div>

                <div class="mb-3">
                    <label>Tempat Lahir</label>
                    <input type="text" class="form-control" name="tempat_lahir" value="<?= $tempat_lahir ?>">
                </div>

                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" class="form-control" name="email" value="<?= $email ?>">
                </div>

                <div class="mb-3">
                    <label>No. Telp Mahasiswa</label>
                    <input type="text" class="form-control" name="no_telp_mahasiswa" value="<?= $no_telp_mahasiswa ?>">
                </div>

                <div class="mb-3">
                    <label>Alamat Mahasiswa</label>
                    <input type="text" class="form-control" name="alamat_mahasiswa" value="<?= $alamat_mahasiswa ?? '' ?>">
                </div>

                <div class="mb-4">
                    <label>Jenis Kelamin</label><br>
                    <input type="radio" name="jenis_kelamin" value="L" <?= $jenis_kelamin=='L'?'checked':'' ?>> Laki-laki
                    <input type="radio" name="jenis_kelamin" value="P" class="ms-3" <?= $jenis_kelamin=='P'?'checked':'' ?>> Perempuan
                </div>

                <hr>

                <div class="mb-3">
                    <label>Nama Wali</label>
                    <input type="text" class="form-control" name="nama_wali" value="<?= $nama_wali ?? '' ?>">
                </div>

                <div class="mb-3">
                    <label>Email Wali</label>
                    <input type="email" class="form-control" name="email_wali" value="<?= $email_wali ?? '' ?>">
                </div>

                <div class="mb-3">
                    <label>No. Telp Wali</label>
                    <input type="text" class="form-control" name="no_telp_wali" value="<?= $no_telp_wali ?? '' ?>">
                </div>

                <div class="mb-4">
                    <label>Alamat Wali</label>
                    <input type="text" class="form-control" name="alamat_wali" value="<?= $alamat_wali ?? '' ?>">
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary px-5">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>

        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
