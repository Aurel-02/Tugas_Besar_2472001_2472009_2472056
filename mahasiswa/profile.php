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

    <link rel="stylesheet" href="../css/sidebar.css">
    <link rel="stylesheet" href="../css/dashboard.css">
    <link rel="stylesheet" href="../css/profile.css">
</head>
<body>

<div class="layout">

    <?php include __DIR__ . '/include/sidebar.php'; ?>

    <div class="content">

        <!-- TOP BAR -->
        <div class="topbar profile-top">
            <div class="profile-header">
                <div class="avatar-big"></div>
                <h2><?= $_SESSION['nama'] ?></h2>
                <p><?= $_SESSION['user_id'] ?></p>
                <small><?= $_SESSION['email'] ?? 'email@email.com' ?></small>
            </div>

            <div class="home-btn"></div>
        </div>

        <!-- CARD PROFIL -->
        <div class="profile-card">

            <div class="profile-grid">

                <div>
                    <label>Nama Lengkap</label>
                    <p><?= $_SESSION['nama'] ?></p>
                </div>

                <div>
                    <label>Fakultas</label>
                    <p>Teknologi dan Rekayasa Cerdas</p>
                </div>

                <div>
                    <label>NRP</label>
                    <p><?= $_SESSION['user_id'] ?></p>
                </div>

                <div>
                    <label>Prodi</label>
                    <p><?= $_SESSION['prodi'] ?></p>
                </div>

                <div>
                    <label>Tanggal Lahir</label>
                    <p>02/11/2005</p>
                </div>

                <div>
                    <label>Status</label>
                    <p>Aktif</p>
                </div>

                <div>
                    <label>Tempat Lahir</label>
                    <p>Bandung</p>
                </div>

                <div>
                    <label>Handphone</label>
                    <p>0859xxxxxxxx</p>
                </div>

                <div>
                    <label>Jenis Kelamin</label>
                    <p>Perempuan</p>
                </div>

                <div>
                    <label>Angkatan</label>
                    <p>2024</p>
                </div>

            </div>

            <div class="edit-btn">
                <button>Edit Profile</button>
            </div>

        </div>

    </div>
</div>

</body>
</html>
