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
    <title>Nilai</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/sidebar.css">
    <link rel="stylesheet" href="/Tugas_Besar_2472001_2472009_2472056/css/nilai_mahasiswa.css">
</head>
<body>

<div class="layout">

    <?php include __DIR__ . '/include/sidebar.php'; ?>

    <div class="main-content">

        <div class="nilai-header d-flex align-items-center justify-content-between px-4">
            <h2 class="mb-0 text-white flex-grow-1 text-start">Transkrip Nilai</h2>
            <select class="form-select form-select-sm w-auto">
                <option>Transkrip</option>
                <option value="Nilai_Perkuliahan">Nilai Perkuliahan</option>
            </select>
        </div>

        <div class="container mt-4">
            <div class="row text-center">
                <div class="col-md-6">
                    <div class="stat-box">
                        <div class="stat-title">IPK</div>
                        <div class="stat-value">4.00</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="stat-box">
                        <div class="stat-title">SKS TEMPUH</div>
                        <div class="stat-value">18</div>
                    </div>
                </div>
            </div>

            <div class="card semester-card mt-4">
                <div class="card-header text-center fw-bold">
                    Semester 1
                </div>

                <div class="card-body">

                    <div class="matkul-item d-flex justify-content-between">
                        <div>
                            <div class="fw-bold">IN210 - JARINGAN KOMPUTER</div>
                            <small class="text-muted">3 sks</small>
                        </div>
                        <div class="nilai-huruf">A</div>
                    </div>

                    <hr>

                    <div class="matkul-item d-flex justify-content-between">
                        <div>
                            <div class="fw-bold">IN210 - JARINGAN KOMPUTER</div>
                            <small class="text-muted">3 sks</small>
                        </div>
                        <div class="nilai-huruf">A</div>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>

</body>
</html>