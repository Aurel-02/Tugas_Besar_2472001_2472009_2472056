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
    <title>DKBS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/Tugas_Besar_2472001_2472009_2472056/css/sidebar.css">
    <link rel="stylesheet" href="/Tugas_Besar_2472001_2472009_2472056/css/dkbs.css">
</head>
<body>

<div class="layout">

    <?php include __DIR__ . '/include/sidebar.php'; ?>

    <div class="main-content">

        <div class="dkbs-header d-flex justify-content-between align-items-center px-4">
            <h2 class="mb-0 text-white">DKBS</h2>
        </div>

        <div class="container mt-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <label class="me-2">Semester Perkuliahan</label>
                </div>
                <div>
                    <select class="form-select form-select-sm d-inline-block w-auto">
                        <option>1</option>
                        <option>2</option>
                    </select>
                </div>
            </div>

            <div class="card dkbs-card">
                <div class="card-body">
                    <?php
                    include __DIR__ . '/../koneksi.php';
                    
                    $nrp = $_SESSION['user_id'];    

                    $query = "
                        SELECT 
                            d.id_mk, 
                            m.nama_mk, 
                            p.jam_mulai, 
                            p.jam_selesai, 
                            p.kelas, 
                            p.ruang, 
                            p.sks
                        FROM tbdkbs d
                        JOIN tbperwalian p ON d.id_perwalian = p.id_perwalian
                        JOIN tbmatakuliah m ON d.id_mk = m.id_mk
                        WHERE d.nrp = ? 
                        ORDER BY p.jam_mulai
                    ";

                    if ($stmt = $conn->prepare($query)) {
                        $stmt->bind_param("s", $nrp); 
                        $stmt->execute();
                        $result = $stmt->get_result(); 

                        $hari_sekarang = '';
                        $total_sks = 0; 

                        while ($row = $result->fetch_assoc()):

                            $total_sks += $row['sks'];

                                ?>

                                <div class="matkul-item mb-3">
                                    <div class="d-flex justify-content-between">
                                        <strong><?= $row['id_mk'] ?> - <?= $row['nama_mk'] ?></strong>
                                        <span><?= substr($row['jam_mulai'], 0, 5) ?> - <?= substr($row['jam_selesai'], 0, 5) ?></span>
                                    </div>
                                    <div>
                                        <small class="text-muted">
                                            Kelas <?= $row['kelas'] ?> | 
                                            Ruang <?= $row['ruang'] ?>
                                        </small>
                                        <div><strong><?= $row['sks'] ?> SKS</strong></div>
                                    </div>
                                </div>
                            
                        <?php endwhile; ?>

                        <?php
                        if ($hari_sekarang !== '') {
                            echo '</div>';
                        }
                    } else {
                        echo "Error preparing query: " . $conn->error;
                    }
                    ?>
                </div>
                <div class="card-footer">
                    <strong>Total SKS: <?= $total_sks ?> SKS</strong>
                </div>
            </div>

            <div class="mt-4 text-center">
                <a href="/Tugas_Besar_2472001_2472009_2472056/mahasiswa/pilih_matkul.php">Pilih mata kuliah untuk semester selanjutnya</a>
            </div>

        </div>

    </div>

</div>

</body>
</html>
