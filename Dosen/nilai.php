<?php
include __DIR__ . "/../koneksi.php";

/* AMBIL SEMUA MATA KULIAH */
$queryMK = "SELECT * FROM tbmatakuliah ORDER BY nama_mk";
$resultMK = $conn->query($queryMK);
$mataKuliah = $resultMK->fetch_all(MYSQLI_ASSOC);

$queryKelas = "SELECT DISTINCT kelas FROM tbperwalian";
$resultKelas = $conn->query($queryKelas);


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

                <!-- MATA KULIAH -->
                <div class="form-group">
                    <label for="matkul">Mata Kuliah :</label>
                    <select id="matkul" class="form-control" name="matkul">
                        <option value="">Pilih Mata Kuliah</option>
                        <?php foreach ($mataKuliah as $mk) { ?>
                            <option value="<?php echo $mk['id_mk']; ?>">
                                <?php echo $mk['nama_mk']; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>

                <!-- RUANG -->
                <div class="form-group">
                    <label for="kelas">Kelas :</label>
<                   <select id="kelas" class="form-control" name="kelas">

                        <?php if ($resultKelas && $resultKelas->num_rows > 0) { ?>
                            <?php while ($rowKelas = $resultKelas->fetch_assoc()) { ?>
                                <option value="<?php echo $rowKelas['kelas']; ?>">
                                    <?php echo $rowKelas['kelas']; ?>
                                </option>
                            <?php } ?>
                        <?php } ?>
                    </select>
                </div>

                <!-- JENIS PENILAIAN -->
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
