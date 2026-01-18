<?php
session_start();
if (!isset($_SESSION['login']) || $_SESSION['role_id'] !== '3') {
    header("Location: /login.php");
    exit;
}

include __DIR__ . '/../koneksi.php';

$nrp = $_SESSION['user_id'];

$queryProdi = "SELECT id_prodi FROM tbmahasiswa WHERE nrp = ?";
$stmtProdi = $conn->prepare($queryProdi);
$stmtProdi->bind_param("s", $nrp);
$stmtProdi->execute();
$resultProdi = $stmtProdi->get_result();

if ($resultProdi->num_rows > 0) {
    $prodi_data = $resultProdi->fetch_assoc();
    $id_prodi = $prodi_data['id_prodi']; 
} else {

    header("Location: /login.php");
    exit;
}

$semesterAktif = isset($_GET['semester']) ? $_GET['semester'] : 1;
$jenisUjian = isset($_GET['jenis_ujian']) ? $_GET['jenis_ujian'] : 'UTS';

$query = "
    SELECT 
        uj.id_ujian, 
        uj.id_mk, 
        uj.jenis_ujian, 
        uj.tgl_ujian, 
        uj.hari, 
        uj.jam_mulai, 
        uj.jam_selesai, 
        uj.ruang, 
        uj.kelas, 
        m.sks, 
        m.semester,
        m.nama_mk  
    FROM tbujian uj
    JOIN tbmatakuliah m ON uj.id_mk = m.id_mk
    WHERE uj.jenis_ujian = ? 
    AND m.id_prodi = ?  -- Filter berdasarkan id_prodi mahasiswa yang login
    AND m.semester = ?  -- Filter berdasarkan semester aktif
    ORDER BY uj.hari, uj.jam_mulai;
";

$stmt = $conn->prepare($query);
$stmt->bind_param("sii", $jenisUjian, $id_prodi, $semesterAktif);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Jadwal Ujian Tengah Semester</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/sidebar.css">
    <link rel="stylesheet" href="../css/ujian.css">
</head>
<body>

<div class="layout">

    <div class="sidebar">
        <?php include __DIR__ . '/include/sidebar.php'; ?>
    </div>

    <div class="main-content">
        <div class="header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">Jadwal Ujian Tengah Semester</h3>
                </div>

                <div class="col-auto">
                    <select class="form-select form-select-sm" onchange="window.location.href = this.value;">
                        <option value="jadwal_perkuliahan.php<?= (isset($_GET['semester']) ? '?semester=' . $_GET['semester'] : '') ?>" <?php echo (!isset($_GET['jenis_ujian']) ? 'selected' : ''); ?>>Perkuliahan</option>
                        <option value="ujian.php?jenis_ujian=UTS<?= (isset($_GET['semester']) ? '&semester=' . $_GET['semester'] : '') ?>" <?php echo ($jenisUjian == 'UTS' ? 'selected' : ''); ?>>UTS</option>
                        <option value="ujian.php?jenis_ujian=UAS<?= (isset($_GET['semester']) ? '&semester=' . $_GET['semester'] : '') ?>" <?php echo ($jenisUjian == 'UAS' ? 'selected' : ''); ?>>UAS</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="container mt-4 pt-3">
            <div class="row g-4">

                <div class="col-12">
                    <div class="semester-info">
                        <hr class="left-line"> 
                        <label for="semester">Semester <?= $semesterAktif; ?></label> 
                        <hr class="right-line">
                    </div>
                </div>

                <?php

                while ($row = $result->fetch_assoc()) {
                    echo '
                        <div class="col-12">
                            <div class="card uts-card">
                                <div class="card-header">
                                    <span class="fw-bold">' . strtoupper($row['hari']) . '</span>
                                </div>
                                <div class="card-body">
                                    <div class="uts-detail d-flex justify-content-between">
                                        <div>
                                            <div class="fw-bold">' . $row['id_mk'] . ' - ' . $row['nama_mk'] . '</div>
                                            <div>SKS: ' . $row['sks'] . '</div>
                                            <div>Kelas: ' . $row['kelas'] . '</div>
                                            <div>Ruang: ' . $row['ruang'] . '</div>
                                        </div>
                                        <div class="text-end">
                                            <div>Waktu: ' . $row['jam_mulai'] . ' - ' . $row['jam_selesai'] . '</div>
                                            <div class="tanggal">Tanggal Ujian: ' . date("d F Y", strtotime($row['tgl_ujian'])) . '</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    ';
                }
                ?>

            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
