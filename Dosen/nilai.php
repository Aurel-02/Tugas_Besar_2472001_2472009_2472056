<?php
include __DIR__ . "/../koneksi.php";

// Mengambil data untuk Fakultas
$queryFakultas = "SELECT * FROM tbfakultas";
$resultFakultas = $conn->query($queryFakultas);

// Mengambil data untuk Prodi berdasarkan Fakultas
$resultProdi = [];
if (isset($_POST['fakultas']) && !empty($_POST['fakultas'])) {
    $fakultasId = $_POST['fakultas'];
    $queryProdi = "SELECT * FROM tbprodi WHERE id_fakultas = ?";
    $stmtProdi = $conn->prepare($queryProdi);
    $stmtProdi->bind_param("i", $fakultasId);
    $stmtProdi->execute();
    $resultProdi = $stmtProdi->get_result();
}

$resultRuang = [];
if (isset($_POST['prodi']) && !empty($_POST['prodi'])) {
    $prodiId = $_POST['prodi'];
    $queryRuang = "SELECT DISTINCT ruang FROM tbdkbs WHERE id_prodi = ?";
    $stmtRuang = $conn->prepare($queryRuang);
    $stmtRuang->bind_param("i", $prodiId);
    $stmtRuang->execute();
    $resultRuang = $stmtRuang->get_result();
}

// Menutup koneksi database setelah query selesai
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
                <!-- Fakultas Dropdown -->
                <div class="form-group">
                    <label for="fakultas">Fakultas :</label>
                    <select id="fakultas" class="form-control" name="fakultas" onchange="this.form.submit()">
                        <option value="">Pilih Fakultas</option>
                        <?php while ($rowFakultas = $resultFakultas->fetch_assoc()) { ?>
                            <option value="<?php echo $rowFakultas['id_fakultas']; ?>" <?php echo (isset($_POST['fakultas']) && $_POST['fakultas'] == $rowFakultas['id_fakultas']) ? 'selected' : ''; ?>>
                                <?php echo $rowFakultas['nama_fakultas']; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>

                <!-- Prodi Dropdown (Bergantung pada Fakultas yang dipilih) -->
                <div class="form-group">
                    <label for="prodi">Prodi :</label>
                    <select id="prodi" class="form-control" name="prodi" onchange="this.form.submit()">
                        <option value="">Pilih Prodi</option>
                        <?php if (isset($resultProdi) && $resultProdi->num_rows > 0) { ?>
                            <?php while ($rowProdi = $resultProdi->fetch_assoc()) { ?>
                                <option value="<?php echo $rowProdi['id_prodi']; ?>" <?php echo (isset($_POST['prodi']) && $_POST['prodi'] == $rowProdi['id_prodi']) ? 'selected' : ''; ?>>
                                    <?php echo $rowProdi['nama_prodi']; ?>
                                </option>
                            <?php } ?>
                        <?php } ?>
                    </select>
                </div>

                <!-- Ruang Dropdown (Bergantung pada Prodi yang dipilih) -->
                <div class="form-group">
                    <label for="ruang">Ruang :</label>
                    <select id="ruang" class="form-control" name="ruang">
                        <option value="">Pilih Ruang</option>
                        <?php if (isset($resultRuang) && $resultRuang->num_rows > 0) { ?>
                            <?php while ($rowRuang = $resultRuang->fetch_assoc()) { ?>
                                <option value="<?php echo $rowRuang['ruang']; ?>">
                                    <?php echo $rowRuang['ruang']; ?>
                                </option>
                            <?php } ?>
                        <?php } ?>
                    </select>
                </div>

                <!-- Input Nilai (Radio Buttons) -->
                <div class="form-group">
                    <label>Input Nilai :</label>
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
