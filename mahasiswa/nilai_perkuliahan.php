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
    <link rel="stylesheet" href="/Tugas_Besar_2472001_2472009_2472056/css/nilai_perkuliahan.css">
</head>
<body>

<div class="layout">

    <?php include __DIR__ . '/include/sidebar.php'; ?>

    <div class="main-content">

        <div class="nilai-header px-4">
            <div class="row align-items-center h-100">
                <div class="col">
                    <h2 class="mb-0 text-white">Nilai Perkuliahan</h2>
                </div>
                <div class="col-auto">
                    <select class="form-select form-select-sm" onchange="location = this.value;">
                        <option value="/Tugas_Besar_2472001_2472009_2472056/mahasiswa/nilai_perkuliahan.php">Nilai Perkuliahan</option>
                        <option value="/Tugas_Besar_2472001_2472009_2472056/mahasiswa/transkrip.php">Transkrip</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="container mt-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <label class="me-2">Semester Perkuliahan</label>
                    <select class="form-select form-select-sm d-inline-block w-auto">
                        <option>1</option>
                        <option>2</option>
                    </select>
                </div>
                <div class="fw-bold">
                    IPS : <span class="text-primary">4.00</span>
                </div>
            </div>

            <div class="card nilai-card">

                <div class="nilai-item">
                    <div class="d-flex justify-content-between">
                        <strong>IN210 - JARINGAN KOMPUTER</strong>
                        <span class="nilai-huruf">Nilai Huruf : A</span>
                    </div>
                    <div class="nilai-detail">
                        <div>KAT : 90 (60%)</div>
                        <div>UTS : 90 (20%)</div>
                        <div>UAS : 90 (20%)</div>
                        <div><strong>Nilai Akhir : 90</strong></div>
                    </div>
                </div>

                <hr>

                <div class="nilai-item">
                    <div class="d-flex justify-content-between">
                        <strong>IN210 - JARINGAN KOMPUTER</strong>
                        <span class="nilai-huruf">Nilai Huruf : A</span>
                    </div>
                    <div class="nilai-detail">
                        <div>KAT : 90 (60%)</div>
                        <div>UTS : 90 (20%)</div>
                        <div>UAS : 90 (20%)</div>
                        <div><strong>Nilai Akhir : 90</strong></div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>

</body>
</html>
