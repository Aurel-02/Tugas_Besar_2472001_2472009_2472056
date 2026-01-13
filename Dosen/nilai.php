<?php
include __DIR__ . '/../koneksi.php';

// Ambil daftar Prodi
$queryProdi = "SELECT * FROM tbprodi ORDER BY nama_prodi";
$resultProdi = $conn->query($queryProdi);

// Tangkap pilihan Prodi
$prodiId = $_POST['prodi'] ?? null;

// Ambil Mata Kuliah sesuai Prodi
$mataKuliah = [];
if ($prodiId) {
    $queryMK = "SELECT * FROM tbmatakuliah WHERE id_prodi = ?";
    $stmtMK = $conn->prepare($queryMK);
    if (!$stmtMK) die("Prepare mata kuliah gagal: " . $conn->error);
    $stmtMK->bind_param("s", $prodiId);
    $stmtMK->execute();
    $resultMK = $stmtMK->get_result();
    $mataKuliah = $resultMK->fetch_all(MYSQLI_ASSOC);
    $stmtMK->close();
}

// Ambil Ruang sesuai Prodi
$resultRuang = [];
if ($prodiId) {
    $queryRuang = "SELECT DISTINCT ruang FROM tbdkbs WHERE id_prodi = ?";
    $stmtRuang = $conn->prepare($queryRuang);
    if (!$stmtRuang) die("Prepare ruang gagal: " . $conn->error);
    $stmtRuang->bind_param("s", $prodiId);
    $stmtRuang->execute();
    $resultRuang = $stmtRuang->get_result();
}

// Menutup koneksi database
$conn->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lembar Penilaian Dosen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/nilai.css">
</head>
<body>
    <div class="container">
        <div class="form-container">
            <div class="header text-center">
                <h2>Lembar Penilaian Dosen</h2>
            </div>

            <form action="#" method="POST">

                <!-- Prodi Dropdown -->
                <div class="form-group">
                    <label for="prodi">Prodi :</label>
                    <select id="prodi" class="form-control" name="prodi" onchange="this.form.submit()">
                        <option value="">Pilih Prodi</option>
                        <?php while ($rowProdi = $resultProdi->fetch_assoc()) { ?>
                            <option value="<?php echo $rowProdi['id_prodi']; ?>" <?php echo ($prodiId == $rowProdi['id_prodi']) ? 'selected' : ''; ?>>
                                <?php echo $rowProdi['nama_prodi']; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>

                <!-- Mata Kuliah Dropdown -->
                <div class="form-group">
                    <label for="matkul">Mata Kuliah :</label>
                    <select id="matkul" class="form-control" name="matkul" <?= $prodiId ? '' : 'disabled' ?>>
                        <option value="">Pilih Mata Kuliah</option>
                        <?php foreach ($mataKuliah as $mk) { ?>
                            <option value="<?php echo $mk['id_matkul']; ?>">
                                <?php echo $mk['nama_matkul']; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>

                <!-- Ruang Dropdown -->
                <div class="form-group">
                    <label for="ruang">Ruang :</label>
                    <select id="ruang" class="form-control" name="ruang">
                        <option value="">Pilih Ruang</option>
                        <?php if ($resultRuang && $resultRuang->num_rows > 0) { ?>
                            <?php while ($rowRuang = $resultRuang->fetch_assoc()) { ?>
                                <option value="<?php echo $rowRuang['ruang']; ?>">
                                    <?php echo $rowRuang['ruang']; ?>
                                </option>
                            <?php } ?>
                        <?php } ?>
                    </select>
                </div>

                <!-- Jenis Penilaian (Radio Buttons) -->
                <div class="form-group">
                    <label>Jenis Penilaian :</label>
                    <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                        <input type="radio" class="btn-check" name="nilai" id="kat" autocomplete="off">
                        <label class="btn btn-outline-primary" for="kat">KAT</label>

                        <input type="radio" class="btn-check" name="nilai" id="uts" autocomplete="off">
                        <label class="btn btn-outline-primary" for="uts">UTS</label>

                        <input type="radio" class="btn-check" name="nilai" id="uas" autocomplete="off">
                        <label class="btn btn-outline-primary" for="uas">UAS</label>
                    </div>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary mt-4">Lanjut</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>