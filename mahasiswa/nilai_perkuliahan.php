<?php
session_start();
if (!isset($_SESSION['login']) || $_SESSION['role_id'] !== '3') {
    header("Location: /login.php");
    exit;
}

$semesterMax = 8; 

$semester = isset($_GET['semester']) ? $_GET['semester'] : 1;

include __DIR__ . '/../koneksi.php';

$nrp = $_SESSION['user_id'];

$querySemester = "
    SELECT DISTINCT m.semester
    FROM tbmatakuliah m
    JOIN tbnilai n ON n.id_mk = m.id_mk
    JOIN tbtranskrip t ON t.id_transkrip = n.id_transkrip
    WHERE t.nrp = ?
";

$stmt = $conn->prepare($querySemester);

if (!$stmt) {
    die("Error preparing query: " . $conn->error);
}

$stmt->bind_param("s", $nrp);
$stmt->execute();
$result = $stmt->get_result();

$availableSemesters = [];
while ($row = $result->fetch_assoc()) {
    $availableSemesters[] = $row['semester'];
}

$semester = isset($_GET['semester']) && in_array($_GET['semester'], $availableSemesters) ? $_GET['semester'] : (count($availableSemesters) > 0 ? $availableSemesters[0] : 1);

$query = "
    SELECT 
        n.id_mk, 
        m.nama_mk,
        n.nilai_akhir,
        n.nilai_uts,
        n.nilai_uas,
        n.nilai_kat,
        n.nilai_mutu,
        n.presentase_nilai_kat,
        n.presentase_nilai_uts,
        n.presentase_nilai_uas,
        m.semester,
        t.ip_semester
    FROM tbnilai n
    JOIN tbmatakuliah m ON n.id_mk = m.id_mk
    JOIN tbtranskrip t ON n.id_transkrip = t.id_transkrip
    WHERE t.nrp = ? AND m.semester = ? 
    ORDER BY m.nama_mk
";

$stmt = $conn->prepare($query);

if ($stmt) {
    $stmt->bind_param("si", $nrp, $semester);
    $stmt->execute();
    $result = $stmt->get_result();


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
                    <span>IPS : <?= isset($row['ip_semester']) && $row['ip_semester'] !== null ? $row['ip_semester'] : '-' ?></span>
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
                                <div>KAT : <?= htmlspecialchars($row['nilai_kat']) ?> (<?= rtrim(rtrim($row['presentase_nilai_kat'], 0), '.') ?: '-' ?>%)</div>
                                <div>UTS : <?= htmlspecialchars($row['nilai_uts']) ?> (<?= rtrim(rtrim($row['presentase_nilai_uts'], 0), '.') ?: '-' ?>%)</div>
                                <div>UAS : <?= htmlspecialchars($row['nilai_uas']) ?> (<?= rtrim(rtrim($row['presentase_nilai_uas'], 0), '.') ?: '-' ?>%)</div>
                                <div><strong>Nilai Akhir : <?= htmlspecialchars($row['nilai_akhir']) ?: '-' ?></strong></div>
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
