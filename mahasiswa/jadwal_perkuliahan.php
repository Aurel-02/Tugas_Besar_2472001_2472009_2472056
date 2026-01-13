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
    <title>Jadwal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/sidebar.css">
    <link rel="stylesheet" href="../css/jadwal_perkuliahan.css">
</head>
<body>
<?php
include __DIR__ . '/../koneksi.php';

$nrp = $_SESSION['user_id'];
$semester = 1; 

$query = "
    SELECT 
        p.hari, p.jam_mulai, p.jam_selesai,
        p.kelas, p.ruang, p.sks,
        d.id_mk, d.nama_mk
    FROM tbdkbs d
    JOIN tbperwalian p ON d.id_perwalian = p.id_perwalian
    WHERE d.nrp = ?
    ORDER BY 
        FIELD(p.hari,'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'),
        p.jam_mulai
";

$stmt = $conn->prepare($query);
$stmt->bind_param("s", $nrp);
$stmt->execute();
$result = $stmt->get_result();
?>

<div class="layout">

    <?php include __DIR__ . '/include/sidebar.php'; ?>

    <div class="main-content">
        <div class="jadwal-header px-4">
            <div class="row align-items-center h-100">
                <div class="col">
                    <h2 class="mb-0 text-white">Jadwal Perkuliahan</h2>
                </div>
                <div class="col-auto">
                    <select class="form-select form-select-sm">
                        <option value="1">Perkuliahan</option>
                        <option value="2">UTS</option>
                        <option value="3">UAS</option>
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
            </div>

            <div class="card jadwal-card">

                <?php
                $hari_sekarang = ''; // Menyimpan nama hari

                while ($row = $result->fetch_assoc()):

                    // Jika hari sekarang tidak sama dengan hari di baris ini
                    if ($hari_sekarang !== $row['hari']):

                        // Tutup div hari sebelumnya
                        if ($hari_sekarang !== '') {
                            echo '</div>';
                        }

                        // Ubah hari_sekarang menjadi hari yang baru
                        $hari_sekarang = $row['hari'];
                        ?>
                        <!-- Tampilkan nama hari dalam header -->
                        <div class="jadwal-hari mb-4">
                            <strong class="d-block mb-2"><?= strtoupper($hari_sekarang) ?></strong>
                        <?php endif; ?>

                    <!-- Jadwal kuliah detail -->
                    <div class="jadwal-detail mb-3">
                        <div><?= $row['id_mk'] ?> - <?= $row['nama_mk'] ?></div>
                        <div><?= $row['sks'] ?> SKS</div>
                        <div>Kelas <?= $row['kelas'] ?></div>
                        <div><?= $row['ruang'] ?></div>
                        <div>
                            <strong>
                                <?= substr($row['jam_mulai'], 0, 5) ?> -
                                <?= substr($row['jam_selesai'], 0, 5) ?>
                            </strong>
                        </div>
                    </div>

                    <!-- Garis pemisah antar jadwal dalam hari yang sama -->
                    <hr class="my-2">

                <?php endwhile; ?>

                <?php
                // Pastikan untuk menutup div terakhir jika hari terakhir sudah selesai diproses
                if ($hari_sekarang !== '') {
                    echo '</div>';
                }
                ?>
            </div>
        </div>

    </div>
</div>

</body>
</html>
