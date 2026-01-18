<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Mahasiswa</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/dashboard.css">
    <link rel="stylesheet" href="../css/sidebar.css">
</head>
<body>
<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: /TUGAS_BESAR_2472001_2472009_2472056/login.php?role=3");
    exit;
}

if ($_SESSION['role_id'] !== '3') {
    header("Location: /TUGAS_BESAR_2472001_2472009_2472056/login.php?role=".$_SESSION['role_id']);
    exit;
}

include __DIR__ . '/../koneksi.php';

$userId = $_SESSION['user_id'];
$query = "SELECT * FROM vwMahasiswa WHERE NRP = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $userId); 
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $mahasiswa = $result->fetch_assoc();
} else {
    $mahasiswa = null;
}

$stmt->close();
?>
<div class="d-flex min-vh-100">

    <?php include __DIR__ . '/include/sidebar.php'; ?>

    <main class="content flex-grow-1 p-4">

        <div class="topbar d-flex justify-content-between align-items-center">
            <a href="profile.php" class="text-decoration-none text-dark">
                <div class="d-flex align-items-center gap-4">
                    <div class="avatar"></div>
                    <div>
                        <div class="fw-bold">
                            <?php echo $mahasiswa['Nama'] ?? 'Nama tidak ditemukan'; ?>
                        </div>
                        <small class="text-muted">
                            <?php echo $mahasiswa['NRP'] ?? 'NRP tidak ditemukan'; ?><br>
                            <?php echo $mahasiswa['Prodi'] ?? 'Prodi tidak ditemukan'; ?>
                        </small>
                    </div>
                </div>
            </a>
        </div>
          
            <div class="page">
                <h5 class="mb-3 fw-semibold">Pengumuman Beasiswa</h5>
                <div class="pengumuman-scroll">
                    <div class="pengumuman-card">
                        <img src="../img/pengumuman1.jpeg" alt="Pengumuman 1">
                    </div>
                    <br>
                    <h5 class="mb-3 fw-semibold">Pengumuman seminar</h5>
                    <div class="pengumuman-card">
                        <img src="../img/pengumuman2.jpeg" alt="Pengumuman 2">
                    </div>
            </div>

    </main>

</div>

</body>
</html>