<?php
session_start();
if (!isset($_SESSION['login']) || $_SESSION['role_id'] !== '2') {
    header("Location: /TUGAS_BESAR_2472001_2472009_2472056/login.php?role=2");
    exit;
}

include __DIR__ . "/../koneksi.php";

/* Query data dosen + prodi */
$sql = "
    SELECT 
        d.nama_dosen,
        d.nip,
        d.email,
        d.tgl_lahir,
        d.tempat_lahir,
        d.jenis_kelamin,
        d.no_telp,
        d.alamat,
        p.nama_prodi
    FROM tbdosen d
    INNER JOIN tbprodi p ON d.id_prodi = p.id_prodi
    WHERE d.nip = ?
";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Data dosen tidak ditemukan");
}

$row = $result->fetch_assoc();

$nama_dosen    = $row['nama_dosen'];
$nip           = $row['nip'];
$email         = $row['email'];
$tgl_lahir     = $row['tgl_lahir'];
$tempat_lahir = $row['tempat_lahir'];
$jenis_kelamin = $row['jenis_kelamin'];
$no_telp       = $row['no_telp'];
$alamat        = $row['alamat'];
$nama_prodi    = $row['nama_prodi'];

$jenis_kelamin_text = $jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan';

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Profil Dosen</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/sidebar.css">
    <link rel="stylesheet" href="../css/profile.css">
</head>
<body>

<div class="layout">
    <?php include __DIR__ . '/include/sidebar.php'; ?>

    <div class="main-content">
        <div class="container mt-3">
            <div class="profile-header text-center p-4 bg-white rounded shadow">
                <img src="../img/profile_icon.png" width="120" class="mb-2">
                <h2><?= $nama_dosen ?></h2>
                <p class="mb-0"><?= $nip ?></p>
                <p class="mb-0"><?= $email ?></p>
            </div>

            <div class="profile-details mt-4">
                <div class="profile-card bg-white p-4 rounded shadow">
                    <div class="row">
                        <div class="col-6"><label>Nama Lengkap</label><p><?= $nama_dosen ?></p></div>
                        <div class="col-6"><label>Fakultas</label><p>Teknologi dan Rekayasa Cerdas</p></div>
                        <div class="col-6"><label>NIP</label><p><?= $nip ?></p></div>
                        <div class="col-6"><label>Program Studi</label><p><?= $nama_prodi ?></p></div>
                        <div class="col-6"><label>Tanggal Lahir</label><p><?= $tgl_lahir ?></p></div>
                        <div class="col-6"><label>Tempat Lahir</label><p><?= $tempat_lahir ?></p></div>
                        <div class="col-6"><label>No. Telepon</label><p><?= $no_telp ?></p></div>
                        <div class="col-6"><label>Jenis Kelamin</label><p><?= $jenis_kelamin_text ?></p></div>
                        <div class="col-12"><label>Alamat</label><p><?= $alamat ?></p></div>
                    </div>
                </div>
            </div>

            <div class="mt-4 text-end mb-5">
                <a href="#" data-bs-toggle="modal" data-bs-target="#editProfileModal">✏️ Edit Profile</a>
            </div>
        </div>
    </div>
</div>

<!-- MODAL EDIT -->
<div class="modal fade" id="editProfileModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Edit Data Dosen</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <form action="update.php" method="POST">

                    <input type="hidden" name="nip" value="<?= $nip ?>">

                    <div class="mb-3">
                        <label>Nama Lengkap</label>
                        <input type="text" class="form-control" value="<?= $nama_dosen ?>" disabled>
                    </div>

                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email" value="<?= $email ?>">
                    </div>

                    <div class="mb-3">
                        <label>Tanggal Lahir</label>
                        <input type="date" class="form-control" name="tgl_lahir" value="<?= $tgl_lahir ?>">
                    </div>

                    <div class="mb-3">
                        <label>Tempat Lahir</label>
                        <input type="text" class="form-control" name="tempat_lahir" value="<?= $tempat_lahir ?>">
                    </div>

                    <div class="mb-3">
                        <label>No. Telepon</label>
                        <input type="text" class="form-control" name="no_telp" value="<?= $no_telp ?>">
                    </div>

                    <div class="mb-3">
                        <label>Alamat</label>
                        <input type="text" class="form-control" name="alamat" value="<?= $alamat ?>">
                    </div>

                    <div class="mb-3">
                        <label>Jenis Kelamin</label><br>
                        <input type="radio" name="jenis_kelamin" value="L" <?= $jenis_kelamin=='L'?'checked':'' ?>> Laki-laki
                        <input type="radio" name="jenis_kelamin" value="P" class="ms-3" <?= $jenis_kelamin=='P'?'checked':'' ?>> Perempuan
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary px-5">Simpan</button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
