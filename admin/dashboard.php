<?php
// dashboard.php
include 'layout/header.php';
include 'layout/sidebar.php';
?>

<div class="main">

    <!-- Header / Topbar -->
    <div class="topbar">
        <div class="admin">
            <div class="avatar"></div>
            <span>Admin</span>
        </div>
    </div>

    <!-- Content -->
    <div class="content">
        <h4 class="mb-4">Dashboard</h4>

        <!-- Card Statistik -->
        <div class="row g-3 mb-4">
            <div class="col-md-3">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h6>Mahasiswa</h6>
                        <h4>120</h4>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h6>Dosen</h6>
                        <h4>25</h4>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h6>Mata Kuliah</h6>
                        <h4>40</h4>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h6>Jadwal</h6>
                        <h4>18</h4>
                    </div>
                </div>
            </div>
        </div>

        <!-- Konten Besar -->
        <div class="card shadow-sm">
            <div class="card-body" style="height: 260px;">
                <h6>Informasi</h6>
                <p class="text-muted">
                    Selamat datang di Portal Admin.
                </p>
            </div>
        </div>

    </div> <!-- content -->

<?php include 'layout/footer.php'; ?>
