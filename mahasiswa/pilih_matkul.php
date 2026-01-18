<?php
session_start();

if (!isset($_SESSION['login']) || $_SESSION['role_id'] !== '3') {
    header("Location: /login.php");
    exit;
}

include __DIR__ . '/../koneksi.php';

$nrp = $_SESSION['user_id'];

$query_prodi = "SELECT id_prodi FROM tbmahasiswa WHERE nrp = ?";
$stmt_prodi = $conn->prepare($query_prodi);

if (!$stmt_prodi) {
    die("Prepare failed for prodi query: " . mysqli_error($conn)); 
}

$stmt_prodi->bind_param("s", $nrp);
$stmt_prodi->execute();
$result_prodi = $stmt_prodi->get_result();
$prodi_data = $result_prodi->fetch_assoc();
$id_prodi = $prodi_data['id_prodi'];

$query = "
    SELECT m.id_mk, m.nama_mk, p.kelas, p.hari, p.jam_mulai, p.jam_selesai, p.ruang, m.sks, m.semester
    FROM tbmatakuliah m
    JOIN tbperwalian p ON m.id_mk = p.id_mk
    WHERE m.id_prodi = ? 
    AND m.id_mk NOT IN (
        SELECT id_mk 
        FROM tbdkbs 
        WHERE nrp = ?
    )
    ORDER BY m.semester, m.id_mk
";

$stmt = $conn->prepare($query);

if (!$stmt) {
    die("Prepare failed for main query: " . mysqli_error($conn)); 
}

$stmt->bind_param("ss", $id_prodi, $nrp);
$stmt->execute();
$result = $stmt->get_result();

$mataKuliahPerSemester = [];

while ($row = $result->fetch_assoc()) {
    $semester = $row['semester'];
    if (!isset($mataKuliahPerSemester[$semester])) {
        $mataKuliahPerSemester[$semester] = [];
    }
    $mataKuliahPerSemester[$semester][] = $row;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id_mk'])) {
    $id_mk = $_POST['id_mk'];

    $query_sp_pilih_mk = "CALL sp_pilih_mk(?, ?)";
    $stmt_sp_pilih_mk = $conn->prepare($query_sp_pilih_mk);

    if (!$stmt_sp_pilih_mk) {
        die("Prepare failed for sp_pilih_mk: " . mysqli_error($conn));
    }

    $stmt_sp_pilih_mk->bind_param("ss", $nrp, $id_mk);
    $stmt_sp_pilih_mk->execute();

    header("Location: pilih_matkul.php");
    exit();
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

        <div>
            <div class="container mt-4">
                <?php foreach ($mataKuliahPerSemester as $semester => $mataKuliahList): ?>
                    <div class="semester-info">
                        <hr class="left-line"> 
                        <label for="semester">Semester <?= $semester ?></label> 
                        <hr class="right-line">
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

                                <form action="pilih_matkul.php" method="POST">
                                    <input type="hidden" name="id_mk" value="<?= $row['id_mk'] ?>">
                                    <button type="submit" class="btn btn-primary">Pilih</button>
                                </form>
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
