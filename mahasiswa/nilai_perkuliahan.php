<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Cek apakah user sudah login dan memiliki role yang benar
if (!isset($_SESSION['login']) || $_SESSION['role_id'] !== '3') {
    header("Location: /login.php");
    exit;
}

// Tentukan nilai maksimal semester (misalnya 8 semester)
$semesterMax = 8; 

// Ambil semester yang ada berdasarkan nilai yang ada di database
include __DIR__ . '/../koneksi.php';
$nrp = $_SESSION['user_id'];

// Query untuk mengecek semester yang memiliki data nilai
$querySemester = "
    SELECT DISTINCT pw.semester
    FROM tbperwalian pw
    JOIN tbmatakuliah mk ON mk.id_mk = pw.id_mk
    JOIN tbnilai n ON n.id_mk = mk.id_mk
    WHERE n.nrp = ?
";

$stmt = $conn->prepare($querySemester);
$stmt->bind_param("s", $nrp);
$stmt->execute();
$result = $stmt->get_result();

$availableSemesters = [];
while ($row = $result->fetch_assoc()) {
    $availableSemesters[] = $row['semester'];
}

// Tentukan semester berdasarkan GET parameter, default ke 1 jika tidak ada parameter
$semester = isset($_GET['semester']) && in_array($_GET['semester'], $availableSemesters) ? $_GET['semester'] : (count($availableSemesters) > 0 ? $availableSemesters[0] : 1);
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
                    <select class="form-select form-select-sm d-inline-block w-auto" onchange="location = this.value;">
                        <?php foreach ($availableSemesters as $semesterOption): ?>
                            <option value="?semester=<?= $semesterOption ?>" <?= ($semester == $semesterOption) ? 'selected' : '' ?>><?= $semesterOption ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="fw-bold">
                    IPS : <span class="text-primary">4.00</span>
                </div>
            </div>

            <div class="card nilai-card">

                <?php
                // Query untuk mengambil data nilai berdasarkan semester dan persentase
                $query = "
                    SELECT 
                        n.id_mk, 
                        m.nama_mk,
                        n.nilai_akhir,
                        n.nilai_uts,
                        n.nilai_uas,
                        n.nilai_kat,
                        n.nilai_mutu,
                        pw.ip_semester,
                        n.persentase_nilai_kat,
                        n.persentase_nilai_uts,
                        n.persentase_nilai_uas
                    FROM tbnilai n
                    JOIN tbdkbs m ON n.id_mk = m.id_mk
                    JOIN tbtranskrip t ON n.id_transkrip = t.id_transkrip
                    JOIN tbmatakuliah mk ON n.id_mk = mk.id_mk
                    JOIN tbperwalian pw ON mk.id_mk = pw.id_mk
                    WHERE t.nrp = ? AND pw.semester = ? 
                ";

                // Cek jika query berhasil disiapkan
                if ($stmt = $conn->prepare($query)) {
                    $stmt->bind_param("si", $nrp, $semester); // Mengikat parameter
                    $stmt->execute(); // Menjalankan query
                    $result = $stmt->get_result(); // Mendapatkan hasil

                    // Menampilkan data nilai jika ada
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()):
                        ?>
                            <div class="nilai-item">
                                <div class="d-flex justify-content-between">
                                    <strong><?= htmlspecialchars($row['nama_mk']) ?></strong>
                                    <span class="nilai-huruf">Nilai Huruf : <?= $row['nilai_mutu'] ?: '-' ?></span>
                                </div>
                                <div class="nilai-detail">
                                    <div>KAT : <?= htmlspecialchars($row['nilai_kat']) ?> (<?= $row['persentase_nilai_kat'] ?: '-' ?>%)</div>
                                    <div>UTS : <?= htmlspecialchars($row['nilai_uts']) ?> (<?= $row['persentase_nilai_uts'] ?: '-' ?>%)</div>
                                    <div>UAS : <?= htmlspecialchars($row['nilai_uas']) ?> (<?= $row['persentase_nilai_uas'] ?: '-' ?>%)</div>
                                    <div><strong>Nilai Akhir : <?= htmlspecialchars($row['nilai_akhir']) ?: '-' ?></strong></div>
                                </div>
                            </div>

                            <hr>

                        <?php endwhile; ?>

                    <?php
                    } else {
                        echo '<div class="p-4 text-center text-muted">Nilai belum tersedia untuk semester ini.</div>';
                    }
                } else {
                    // Menampilkan pesan error jika query gagal dipersiapkan
                    echo "Error preparing query: " . $conn->error;
                }
                ?>

            </div>
        </div>

    </div>
</div>

</body>
</html>
