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
    <title>Jadwal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/sidebar.css">
    <link rel="stylesheet" href="../css/jadwal_perkuliahan.css">
</head>
<body>

<div class="layout">

    <?php include __DIR__ . '/include/sidebar.php'; ?>

    <div class="main-content">
        <div class="jadwal-header px-4">
            <div class="row align-items-center h-100">
                <div class="col">
                    <h2 class="mb-0 text-white">Jadwal Perkuliahan</h2>
                </div>
                <div class="col-auto">
                    <select class="form-select form-select-sm">
                        <option value="1">Perkuliahan</option>
                        <option value="2">UTS</option>
                        <option value="3">UAS</option>
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
            </div>

            <div class="card jadwal-card">
                <div class="jadwal-item">
                    <div class="d-flex justify-content-between">
                        <strong>SENIN</strong>
                    </div>
                    <div class="jadwal-detail">
                        <div>IN231 - Teknologi Multimedia</div>
                        <div>3 sks</div>
                        <div>Kelas A</div>
                        <div>Lab ADV 3</div>
                        <div><strong>12.30 - 14.10</strong></div>
                    </div>
                </div>

                <hr>

                <div class="jadwal-item">
                    <div class="d-flex justify-content-between">
                        <strong>SELASA</strong>
                    </div>
                    <div class="jadwal-detail">
                        <div>IN231 - Teknologi Multimedia</div>
                        <div>3 sks</div>
                        <div>Kelas A</div>
                        <div>Lab ADV 3</div>
                        <div><strong>12.30 - 14.10</strong></div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>

</body>
</html>
