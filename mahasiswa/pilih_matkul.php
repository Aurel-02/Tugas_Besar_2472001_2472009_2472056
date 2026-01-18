
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
<?php
session_start();

if (!isset($_SESSION['login']) || $_SESSION['role_id'] !== '3') {
    header("Location: /login.php");
    exit;
}

include __DIR__ . '/../koneksi.php'; // Koneksi database

$nrp = $_SESSION['user_id']; // Ambil NRP mahasiswa dari session

// Query untuk mengambil id_prodi mahasiswa
$query_prodi = "SELECT id_prodi FROM tbmahasiswa WHERE nrp = ?";
$stmt_prodi = $conn->prepare($query_prodi);

// Cek apakah prepare untuk query_prodi berhasil
if (!$stmt_prodi) {
    die("Prepare failed for prodi query: " . mysqli_error($conn)); 
}

$stmt_prodi->bind_param("s", $nrp);
$stmt_prodi->execute();
$result_prodi = $stmt_prodi->get_result();
$prodi_data = $result_prodi->fetch_assoc();
$id_prodi = $prodi_data['id_prodi']; // Ambil id_prodi dari query

// Memanggil Stored Procedure untuk mengambil mata kuliah yang belum diambil
$query = "CALL sp_get_mata_kuliah_yang_belum_diambil(?, ?)";
$stmt = $conn->prepare($query);

// Cek apakah prepare untuk query utama berhasil
if (!$stmt) {
    die("Prepare failed for main query: " . mysqli_error($conn)); 
}

$stmt->bind_param("si", $nrp, $id_prodi); // Menggunakan id_prodi dan nrp untuk query
$stmt->execute();
$result = $stmt->get_result();

$mataKuliahPerSemester = [];

// Mengelompokkan mata kuliah per semester
while ($row = $result->fetch_assoc()) {
    $semester = $row['semester'];
    if (!isset($mataKuliahPerSemester[$semester])) {
        $mataKuliahPerSemester[$semester] = [];
    }
    $mataKuliahPerSemester[$semester][] = $row;
}
?>

<div class="layout">
    <?php include __DIR__ . '/include/sidebar.php'; ?>

    <div class="main-content">
        <div class="header text-center px-4 py-3">
            <h4 class="mb-0">Pilih Mata Kuliah</h4>
        </div>

        <div>
            <div class="container mt-4">

                <?php foreach ($mataKuliahPerSemester as $semester => $mataKuliahList): ?>
                    <div class="semester-info">
                        <hr class="left-line"> <label for="semester">Semester <?= $semester ?></label> <hr class="right-line">
                    </div>

                    <?php foreach ($mataKuliahList as $row): ?>
                        <div class="card course-card">
                            <div class="course-item d-flex justify-content-between align-items-center">
                                <div>
                                    <strong><?= $row['id_mk'] ?> - <?= $row['nama_mk'] ?></strong>
                                    <div class="course-details">
                                        <small>Kelas <?= $row['kelas'] ?> | Lab <?= $row['ruang'] ?></small><br>
                                        <small><?= $row['hari'] ?>, <?= substr($row['jam_mulai'], 0, 5) ?> - <?= substr($row['jam_selesai'], 0, 5) ?></small><br>
                                        <small><?= $row['sks'] ?> sks</small>
                                    </div>
                                </div>
                                <button class="btn btn-primary pilih-mk" data-id_mk="<?= $mataKuliah['id_mk'] ?>">Pilih</button>
                            </div>
                        </div>
                    <?php endforeach; ?>

                <?php endforeach; ?>

            </div>
        </div>
    </div>
</div>
</body>
</html>