<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Nilai</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/sidebar.css">
    <link rel="stylesheet" href="/Tugas_Besar_2472001_2472009_2472056/css/transkrip_mahasiswa.css">
</head>
<body>
<?php
session_start();
if (!isset($_SESSION['login']) || $_SESSION['role_id'] !== '3') {
    header("Location: /login.php");
    exit;
}

include __DIR__ . '/../koneksi.php';

$nrp = $_SESSION['user_id'];

$query = "CALL sp_GetTranskripNilai(?)";

$stmt = $conn->prepare($query);
$stmt->bind_param("s", $nrp);
$stmt->execute();
$result = $stmt->get_result();

$nilaiPerSemester = [];
$ipk = null;
while ($row = $result->fetch_assoc()) {
    if (!$ipk) {
        $ipk = $row['ipk'];
    }
    $nilaiPerSemester[$row['semester']][] = $row;
}
?>

<div class="layout">

    <?php include __DIR__ . '/include/sidebar.php'; ?>

    <div class="main-content">

        <div class="nilai-header d-flex align-items-center justify-content-between px-4">
            <h2 class="mb-0 text-white flex-grow-1 text-start">Transkrip Nilai</h2>
            <select class="form-select form-select-sm w-auto" onchange="window.location.href=this.value">
                <option value="/Tugas_Besar_2472001_2472009_2472056/mahasiswa/transkrip.php">Transkrip</option>
                <option value="/Tugas_Besar_2472001_2472009_2472056/mahasiswa/nilai_perkuliahan.php">Nilai Perkuliahan</option>
            </select>
        </div>

        <div class="container mt-4">
            <div class="row text-center">
                <div class="col-md-6">
                    <div class="stat-box">
                        <div class="stat-title">IPK</div>
                        <div class="stat-value"><?= $ipk ?: '-' ?></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="stat-box">
                        <div class="stat-title">SKS TEMPUH</div>
                        <div class="stat-value">
                            <?php 
                                $totalSks = 0;
                                foreach ($nilaiPerSemester as $semester => $items) {
                                    foreach ($items as $row) {
                                        $totalSks += $row['total_sks'];
                                    }
                                }
                                echo $totalSks;
                            ?>
                        </div>
                    </div>
                </div>
            </div>

            <?php foreach ($nilaiPerSemester as $semester => $nilaiItems): ?>
                <div class="card semester-card mt-4">
                    <div class="card-header text-center fw-bold">
                        Semester <?= $semester ?>
                    </div>

                    <div class="card-body p-3">
                        <?php foreach ($nilaiItems as $row): ?>
                            <div class="matkul-item d-flex justify-content-between">
                                <div>
                                    <div class="fw-bold"><?= $row['id_mk_prefix'] ?> - <?= $row['nama_mk'] ?></div>
                                    <small class="text-muted"><?= isset($row['total_sks']) ? $row['total_sks'] : '-' ?> sks</small>  <!-- Menampilkan total SKS -->
                                </div>
                                <div class="nilai-huruf">
                                    <?= isset($row['nilai_mutu']) && $row['nilai_mutu'] !== null ? $row['nilai_mutu'] : '-' ?> <!-- Menampilkan nilai mutu -->
                                </div>
                            </div>
                            <hr>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>

    </div>
</div>

</body>
</html>