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
                    <select class="form-select form-select-sm d-inline-block w-auto">
                        <option>1</option>
                        <option>2</option>
                    </select>
                </div>
                <div class="fw-bold">
                    IPS : <span class="text-primary">4.00</span>
                </div>
            </div>

            <div class="card nilai-card">

                <?php
                include __DIR__ . '/../koneksi.php';

                $nrp = $_SESSION['user_id'];

                // Query untuk mengambil data nilai
                $query = "
                    SELECT 
                        n.id_mk, 
                        m.nama_mk,
                        n.nilai_akhir,
                        n.nilai_uts,
                        n.nilai_uas,
                        n.nilai_kat,
                        n.nilai_mutu
                    FROM tbnilai n
                    JOIN tbdkbs m ON n.id_mk = m.id_mk
                    WHERE n.nrp = ?
                ";

                // Cek jika query berhasil disiapkan
                if ($stmt = $conn->prepare($query)) {
                    $stmt->bind_param("s", $nrp); // Mengikat parameter
                    $stmt->execute(); // Menjalankan query
                    $result = $stmt->get_result(); // Mendapatkan hasil

                    // Menampilkan data nilai jika ada
                    while ($row = $result->fetch_assoc()):
                    ?>
                        <div class="nilai-item">
                            <div class="d-flex justify-content-between">
                                <strong><?= $row['nama_mk'] ?></strong>
                                <span class="nilai-huruf">Nilai Huruf : 
                                    <?php
                                        // Menentukan nilai huruf berdasarkan nilai akhir
                                        if ($row['nilai_akhir'] >= 85) {
                                            echo 'A';
                                        } elseif ($row['nilai_akhir'] >= 70) {
                                            echo 'B';
                                        } elseif ($row['nilai_akhir'] >= 60) {
                                            echo 'C';
                                        } else {
                                            echo 'D';
                                        }
                                    ?>
                                </span>
                            </div>
                            <div class="nilai-detail">
                                <div>KAT : <?= $row['nilai_kat'] ?> (60%)</div>
                                <div>UTS : <?= $row['nilai_uts'] ?> (20%)</div>
                                <div>UAS : <?= $row['nilai_uas'] ?> (20%)</div>
                                <div><strong>Nilai Akhir : <?= $row['nilai_akhir'] ?></strong></div>
                            </div>
                        </div>

                        <hr>

                    <?php endwhile; ?>

                    <?php
                    // Jika tidak ada data
                    if ($result->num_rows === 0) {
                        echo '<div class="p-4 text-center text-muted">Nilai belum tersedia</div>';
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
