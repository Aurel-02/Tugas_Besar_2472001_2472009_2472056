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

// Tentukan semester berdasarkan GET parameter, default ke 1 jika tidak ada
$semester = isset($_GET['semester']) ? $_GET['semester'] : 1;

include __DIR__ . '/../koneksi.php'; // Pastikan koneksi ke database sudah benar

$nrp = $_SESSION['user_id'];

// Query untuk mengecek semester yang memiliki data nilai
$querySemester = "
    SELECT DISTINCT pw.semester
    FROM tbperwalian pw
    JOIN tbmatakuliah mk ON mk.id_mk = pw.id_mk
    JOIN tbnilai n ON n.id_mk = mk.id_mk
    JOIN tbtranskrip t ON t.id_transkrip = n.id_transkrip
    WHERE t.nrp = ?
";

$stmt = $conn->prepare($querySemester);

// Periksa apakah query berhasil dipersiapkan
if (!$stmt) {
    die("Error preparing query: " . $conn->error); // Menampilkan pesan error jika gagal
}

$stmt->bind_param("s", $nrp);
$stmt->execute();
$result = $stmt->get_result();

$availableSemesters = [];
while ($row = $result->fetch_assoc()) {
    $availableSemesters[] = $row['semester'];
}

// Tentukan semester berdasarkan GET parameter, default ke 1 jika tidak ada parameter
$semester = isset($_GET['semester']) && in_array($_GET['semester'], $availableSemesters) ? $_GET['semester'] : (count($availableSemesters) > 0 ? $availableSemesters[0] : 1);

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
        n.persentase_nilai_kat,
        n.persentase_nilai_uts,
        n.persentase_nilai_uas,
        IFNULL(pw.ip_semester, '-') AS ip_semester,
        pw.semester
    FROM tbnilai n
    JOIN tbmatakuliah m ON n.id_mk = m.id_mk
    JOIN tbtranskrip t ON n.id_transkrip = t.id_transkrip
    JOIN tbperwalian pw ON m.id_mk = pw.id_mk
    WHERE t.nrp = ? AND pw.semester = ? 
    ORDER BY m.nama_mk
";

$stmt = $conn->prepare($query);

// Cek apakah query berhasil disiapkan
if ($stmt) {
    $stmt->bind_param("si", $nrp, $semester); // Mengikat parameter
    $stmt->execute(); // Menjalankan query
    $result = $stmt->get_result(); // Mendapatkan hasil

    // Menyimpan hasil dalam array untuk pengelompokan per semester
    $nilaiPerSemester = [];
    while ($row = $result->fetch_assoc()) {
        $nilaiPerSemester[$row['semester']][] = $row;
    }
} else {
    echo "Error preparing query: " . $conn->error;
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
                if (isset($nilaiPerSemester[$semester])) {
                    foreach ($nilaiPerSemester[$semester] as $row) {
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
                                <div>IPS : <?= $row['ip_semester'] ?></div>
                            </div>
                        </div>

                        <hr>
                        <?php
                    }
                } else {
                    echo '<div class="p-4 text-center text-muted">Nilai belum tersedia untuk semester ini.</div>';
                }
                ?>

            </div>
        </div>

    </div>
</div>

</body>
</html>
