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
    
    $nama_mahasiswa = $row['nama_mahasiswa'];
    $nrp = $row['nrp'];
    $email = $row['email_mahasiswa'];
    $angkatan = $row['angkatan'];
    $tgl_lahir = $row['tgl_lahir'];
    $tempat_lahir = $row['tempat_lahir'];
    $jenis_kelamin = $row['jenis_kelamin'];
    $no_telp_mahasiswa = $row['no_telp_mahasiswa'];
    $status_mhs = $row['status_mhs'];
    $nama_prodi = $row['nama_prodi'];

    $nama_dosen = $row['nama_dosen'];
    $email_dosen = $row['email_dosen'];
    $no_telp_dosen = $row['no_telp'];
} else {
    echo "Data tidak ditemukan";
}

$stmt->close();
$conn->close();
?>

<div class="layout">

    <?php include __DIR__ . '/include/sidebar.php'; ?>

    <div class="main-content">
        <div class="container-fluid mt-3">
            <div class="row">
                <div class="col-12" style="max-width: 1000px">
                    <div class="profile-header text-center p-4 bg-white rounded shadow">

                        <div class="avatar-big mb-3">
                            <img src="/img/profile_icon.png" alt="Profile Image">
                        </div>
        
                        <h2><?= $nama_mahasiswa ?></h2>
                        <p><?= $nrp ?></p>
                        <small><?= $email ?></small>
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
                                    <p><?= $jenis_kelamin ?></p>
                                </div>
                                <div class="col-6">
                                    <label>Angkatan</label>
                                    <p><?= $angkatan ?></p>
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
                                    <p>Benyamin Tomy</p>
                                </div>
                                <div class="col-6">
                                    <label>Handphone Wali</label>
                                    <p>082654135893</p>
                                </div>
                                <div class="col-6">
                                    <label>Email Wali</label>
                                    <p>benyamin.tomy@gmail.com</p>
                                </div>
                                <div class="col-6">
                                    <label>Alamat Wali</label>
                                    <p>Jalan Anggrek</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 text-center">
                        <button class="btn btn-primary">
                            <i class="bi bi-pencil-square"></i> Edit Profile
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
