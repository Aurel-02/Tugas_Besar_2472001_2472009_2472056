<?php
session_start();
if (!isset($_SESSION['login']) || $_SESSION['role_id'] !== '3') {
    header("Location: /login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Jadwal Ujian Tengah Semester</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/sidebar.css">
    <link rel="stylesheet" href="../css/uts.css">  <!-- UTS-specific CSS -->
</head>
<body>

<div class="layout">
    <!-- Sidebar -->
    <div class="sidebar">
        <?php include __DIR__ . '/include/sidebar.php'; ?>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="header">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="text-white">Jadwal Ujian Tengah Semester</h3>
                <div class="col-auto">
                    <select class="form-select form-select-sm" onchange="window.location.href = this.value;">
                        <option value="jadwal_perkuliahan.php" <?php echo (basename($_SERVER['PHP_SELF']) == 'jadwal_perkuliahan.php' ? 'selected' : ''); ?>>Perkuliahan</option>
                        <option value="uts.php" <?php echo (basename($_SERVER['PHP_SELF']) == 'uts.php' ? 'selected' : ''); ?>>UTS</option>
                        <option value="uas.php" <?php echo (basename($_SERVER['PHP_SELF']) == 'uas.php' ? 'selected' : ''); ?>>UAS</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="container mt-4 pt-3">
            <div class="row g-4">
                <!-- Jadwal UTS Card Example -->
                <div class="col-12">
                    <div class="card uts-card">
                        <div class="card-header">
                            <span class="fw-bold">SENIN</span>
                        </div>
                        <div class="card-body">
                            <div class="uts-detail">
                                <div class="fw-bold">IN231 - Teknologi Multimedia</div>
                                <div>3 SKS</div>
                                <div>Kelas A</div>
                                <div>Ruang Lab ADV 3</div>
                                <div>Waktu 12.30 - 14.10</div>
                            </div>
                            <hr>
                            <div class="uts-detail">
                                <div class="fw-bold">IN231 - Teknologi Multimedia</div>
                                <div>3 SKS</div>
                                <div>Kelas A</div>
                                <div>Ruang Lab ADV 3</div>
                                <div>Waktu 12.30 - 14.10</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Jadwal UTS Card Example -->
                <div class="col-12">
                    <div class="card uts-card">
                        <div class="card-header">
                            <span class="fw-bold">SELASA</span>
                        </div>
                        <div class="card-body">
                            <div class="uts-detail">
                                <div class="fw-bold">IN231 - Teknologi Multimedia</div>
                                <div>3 SKS</div>
                                <div>Kelas A</div>
                                <div>Ruang Lab ADV 3</div>
                                <div>Waktu 12.30 - 14.10</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
