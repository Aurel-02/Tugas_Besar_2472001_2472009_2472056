<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Mahasiswa</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="../css/dashboard.css">
</head>
<body>
<?php
session_start();  

if (!isset($_SESSION['login'])) {
    header("Location: ../login/login_mahasiswa.php");
    exit;
}
?>
<div class="d-flex min-vh-100">

    <aside class="sidebar d-flex flex-column justify-content-between">
        <div>
            <div class="sidebar-logo"></div>
            
            <hr class="sidebar-divider">

            <ul class="nav flex-column sidebar-menu">
                <li class="nav-item">
                    <div class="icon nilai"></div>
                    <span>Nilai</span>
                </li>

                <li class="nav-item">
                    <div class="icon dkbs"></div>
                    <span>DKBS</span>
                </li>

                <li class="nav-item">
                    <div class="icon jadwal"></div>
                    <span>Jadwal</span>
                </li>
            </ul>
        </div>

        <a href="logout.php" class="logout d-flex align-items-center gap-2 text-decoration-none">
            <div class="logout-icon"></div>
            <span class="logout-text">Logout</span>
        </a>
    </aside>

    <main class="flex-grow-1 bg-light">

        <div class="topbar d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center gap-4">
                <div class="avatar"></div>
                <div>
                    <div class="fw-bold">
                        <?= isset($_SESSION['nama']) ? $_SESSION['nama'] : 'Nama tidak ditemukan'; ?>
                    </div>
                    <small class="text-muted">
                        <?= isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 'NRP tidak ditemukan'; ?><br>
                    <?= isset($_SESSION['prodi']) ? $_SESSION['prodi'] : 'Prodi tidak ditemukan'; ?>
                    </small>
                </div>
            </div>

            <div class="notif"></div>
        </div>

    </main>

</div>

</body>
</html>
</html>
