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
    <title>Pilih Mata Kuliah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/Tugas_Besar_2472001_2472009_2472056/css/sidebar.css">
    <link rel="stylesheet" href="/Tugas_Besar_2472001_2472009_2472056/css/pilih_matkul.css">
</head>
<body>

<div class="layout">
    <?php include __DIR__ . '/include/sidebar.php'; ?>

    <div class="main-content">
        <div class="header text-center px-4 py-3">
            <h4 class="mb-0">Pilih Mata Kuliah</h4>
        </div>

        <div class="container mt-4">
            <div class="row mb-4">
                <div class="col-md-12">
                    <div class="semester-info">
                        <label for="semester">Semester 1</label>
                    </div>
                </div>
            </div>

            <div class="card course-card">
                <div class="course-item d-flex justify-content-between align-items-center">
                    <div>
                        <strong>IN231 - Teknologi Multimedia</strong>
                        <div class="course-details">
                            <small>Kelas A | Lab ADV 3</small><br>
                            <small>Senin, 12.30 - 14.10</small>
                        </div>
                    </div>
                    <button class="btn btn-primary">Pilih</button>
                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>
