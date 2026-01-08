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
    <title>DKBS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/Tugas_Besar_2472001_2472009_2472056/css/sidebar.css">
    <link rel="stylesheet" href="/Tugas_Besar_2472001_2472009_2472056/css/dkbs.css">
</head>
<body>

<div class="layout">

    <?php include __DIR__ . '/include/sidebar.php'; ?>

    <div class="main-content">

        <div class="dkbs-header d-flex justify-content-between align-items-center px-4">
            <h2 class="mb-0 text-white">DKBS</h2>
        </div>

        <div class="container mt-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <label class="me-2">Semester Perkuliahan</label>
                </div>
                <div>
                    <select class="form-select form-select-sm d-inline-block w-auto">
                        <option>1</option>
                        <option>2</option>
                    </select>
                </div>
            </div>

            <div class="card dkbs-card">
                <div class="card-body">
                    <div class="matkul-item">
                        <div class="d-flex justify-content-between">
                            <strong>IN231 - Teknologi Multimedia</strong>
                            <span>12.30 - 14.10</span>
                        </div>
                        <div>
                            <small class="text-muted">Kelas A | Lab ADV 3</small>
                            <div><strong>3 SKS</strong></div>
                        </div>
                    </div>
                    <hr>
                    <div class="matkul-item">
                        <div class="d-flex justify-content-between">
                            <strong>IN231 - Teknologi Multimedia</strong>
                            <span>12.30 - 14.10</span>
                        </div>
                        <div>
                            <small class="text-muted">Kelas A | Lab ADV 3</small>
                            <div><strong>3 SKS</strong></div>
                        </div>
                    </div>
                    <hr>
                    <div class="matkul-item">
                        <div class="d-flex justify-content-between">
                            <strong>IN231 - Teknologi Multimedia</strong>
                            <span>12.30 - 14.10</span>
                        </div>
                        <div>
                            <small class="text-muted">Kelas A | Lab ADV 3</small>
                            <div><strong>3 SKS</strong></div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <strong>Total SKS: 18 SKS</strong>
                </div>
            </div>

            <div class="mt-4 text-center">
                <img src="/path/to/logo.png" alt="Logo" class="logo">
                <a href="/Tugas_Besar_2472001_2472009_2472056/mahasiswa/pilih_matkul.php">Pilih mata kuliah untuk semester selanjutnya</a>
            </div>

        </div>

    </div>

</div>

</body>
</html>
