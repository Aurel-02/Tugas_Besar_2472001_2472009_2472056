<?php
include 'layout/header.php';
include '../koneksi.php';
$query = mysqli_query($conn, "SELECT * FROM v_dashboard_admin");
$data  = mysqli_fetch_assoc($query);?>

<div class="sidebar">
    <h4>🎓 Portal Admin</h4>

    <a href="dashboard.php">Dashboard</a>
    <a href="fakultas/index.php">Fakultas</a>
    <a href="prodi/index.php">Program Studi</a>
    <a href="mahasiswa/index.php">Mahasiswa</a>
    <a href="dosen/index.php">Dosen</a>
    <a href="matakuliah/index.php">Mata Kuliah</a>
    <a href="jadwal/index.php">Jadwal</a>

    <hr class="text-white mx-3">

    <a href="../logout.php" class="text-warning">Logout</a>
</div>

<div class="main">
    <div class="topbar">
        <div class="admin">
            <div class="avatar"></div>
            <span>Admin</span>
        </div>
    </div>

    <div class="content">
        <h4 class="mb-4">Dashboard</h4>

        <div class="row g-3 mb-4">

            <div class="col-md-3">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h6>Mahasiswa</h6>
                        <h4><?= $data['total_mahasiswa']; ?></h4>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h6>Dosen</h6>
                        <h4><?= $data['total_dosen']; ?></h4>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h6>Mata Kuliah</h6>
                        <h4><?= $data['total_matakuliah']; ?></h4>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h6>Jadwal</h6>
                        <h4><?= $data['total_jadwal']; ?></h4>
                    </div>
                </div>
            </div>

        </div>

        <div class="card shadow-sm">
            <div class="card-body" style="height: 260px;">
                <h6>Informasi</h6>
                <p class="text-muted">
                    Selamat datang di Portal Admin.
                </p>
            </div>
        </div>

    </div>

<?php include 'layout/footer.php'; ?>
