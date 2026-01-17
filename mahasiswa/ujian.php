<?php
session_start();
if (!isset($_SESSION['login']) || $_SESSION['role_id'] !== '3') {
    header("Location: /login.php");
    exit;
}

include __DIR__ . '/../koneksi.php';

$nrp = $_SESSION['user_id'];
$semester = isset($_GET['semester']) ? (int)$_GET['semester'] : 1; // Default to 1 if no semester is selected

// Query to fetch the exam schedule
$query = "
    SELECT 
        LEFT(t.id_mk, 4) AS id_mk_prefix,  -- Display first 4 characters of id_mk
        m.nama_mk,
        j.hari,
        j.jam_mulai,
        j.jam_selesai,
        j.ruang,
        j.kelas
    FROM tbujian j
    JOIN tbdkbs d ON j.id_mk = d.id_mk
    JOIN tbmatakuliah m ON j.id_mk = m.id_mk
    WHERE d.nrp = ?  -- Filter by student NRP
      AND j.semester = ?  -- Filter by selected semester
    ORDER BY 
        CASE j.hari
            WHEN 'Senin' THEN 1
            WHEN 'Selasa' THEN 2
            WHEN 'Rabu' THEN 3
            WHEN 'Kamis' THEN 4
            WHEN 'Jumat' THEN 5
            ELSE 6
        END,
        j.jam_mulai
";

$stmt = $conn->prepare($query);
$stmt->bind_param("si", $nrp, $semester);
$stmt->execute();
$result = $stmt->get_result();

$jadwalPerHari = [];

while ($row = $result->fetch_assoc()) {
    $jadwalPerHari[$row['hari']][] = $row;
}
?>

<div class="layout">
    <?php include __DIR__ . '/include/sidebar.php'; ?>

    <div class="main-content">
        <div class="jadwal-header px-4">
            <div class="row align-items-center h-100">
                <div class="col">
                    <h3 class="mb-0 text-white">Jadwal Ujian</h3>
                </div>
                <div class="col-auto">
                    <select class="form-select form-select-sm">
                        <option value="1" <?= ($semester == 1) ? 'selected' : '' ?>>Perkuliahan</option>
                        <option value="2" <?= ($semester == 2) ? 'selected' : '' ?>>UTS</option>
                        <option value="3" <?= ($semester == 3) ? 'selected' : '' ?>>UAS</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="container mt-4 pt-3">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <form method="GET" class="d-inline">
                        <label class="me-2">Semester Perkuliahan</label>
                        <select name="semester" class="form-select form-select-sm d-inline-block w-auto" onchange="this.form.submit()">
                            <?php for ($i = 1; $i <= 6; $i++): ?>
                                <option value="<?= $i ?>" <?= ($semester == $i) ? 'selected' : '' ?>><?= $i ?></option>
                            <?php endfor; ?>
                        </select>
                    </form>
                </div>
            </div>

            <div class="row g-4">
                <?php foreach ($jadwalPerHari as $hari => $list): ?>
                    <div class="col-12">
                        <div class="card jadwal-card h-100">
                            <div class="card-header fw-bold"><?= strtoupper($hari) ?></div>
                            <div class="card-body">
                                <?php foreach ($list as $row): ?>
                                    <div class="jadwal-detail mb-3">
                                        <div class="fw-bold"><?= $row['id_mk_prefix'] ?> - <?= $row['nama_mk'] ?></div>
                                        <div>Kelas <?= $row['kelas'] ?></div>
                                        <div>Ruang <?= $row['ruang'] ?></div>
                                        <div>
                                            Waktu 
                                            <?= substr($row['jam_mulai'], 0, 5) ?> -
                                            <?= substr($row['jam_selesai'], 0, 5) ?>
                                        </div>
                                    </div>
                                    <hr>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
</body>
</html>
