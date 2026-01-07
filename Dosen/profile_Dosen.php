<?php
session_start();
if (!isset($_SESSION['login']) || $_SESSION['role_id'] !== '2') {
    header("Location: /TUGAS_BESAR_2472001_2472009_2472056/login.php?role=2");
    exit;
}
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
<?php

include __DIR__ . "/../koneksi.php";

$sql = "
    SELECT 
        nama_dosen, 
        nip, 
        email AS email_dosen, 
        tgl_lahir, 
        tempat_lahir, 
        jenis_kelamin,  
        id_prodi, 
        no_telp

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
    
    $nama_dosen = $row['nama_dosen'];
    $nip = $row['nip'];
    $email = $row['email_dosen'];
    $tgl_lahir = $row['tgl_lahir'];
    $tempat_lahir = $row['tempat_lahir'];
    $jenis_kelamin = $row['jenis_kelamin'];
    $no_telp_dosen = $row['no_telp_dosen'];
    $id_prodi = $row['id_prodi'];
    
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
        
                        <h2><?= $nama_dosen ?></h2>
                        <p><?= $nip ?></p>
                        <small><?= $email ?></small>
                    </div>

                    <div class="profile-details mt-4">
                        <div class="profile-card bg-white p-4 rounded shadow">
                            <div class="row">
                                <div class="col-6">
                                    <label>Nama Lengkap</label>
                                    <p><?= $nama_dosen ?></p>
                                </div>
                                <div class="col-6">
                                    <label>Fakultas</label>
                                    <p>Teknologi dan Rekayasa Cerdas</p>
                                </div>
                                <div class="col-6">
                                    <label>nip</label>
                                    <p><?= $nip ?></p>
                                </div>
                                <div class="col-6">
                                    <label>Prodi</label>
                                    <p><?= $id_prodi ?></p>
                                </div>
                                <div class="col-6">
                                    <label>Tanggal Lahir</label>
                                    <p><?= $tgl_lahir ?></p>
                                </div>
                                <div class="col-6">
                                    <label>Tempat Lahir</label>
                                    <p><?= $tempat_lahir ?></p>
                                </div>
                                <div class="col-6">
                                    <label>Jenis Kelamin</label>
                                    <p><?= $jenis_kelamin ?></p>
                                </div>
                            </div>

                            <hr>

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
