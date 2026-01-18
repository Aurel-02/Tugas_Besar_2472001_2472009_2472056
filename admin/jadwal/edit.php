<?php
include "../../koneksi.php";

$id = $_GET['id'];

$data = mysqli_fetch_assoc(
    mysqli_query($conn, "
        SELECT 
            p.*,
            m.nama_mk,
            d.nama_dosen
        FROM tbperwalian p
        JOIN tbmatakuliah m ON p.id_mk = m.id_mk
        JOIN tbdosen d ON p.nip = d.nip
        WHERE p.id_perwalian = '$id'
    ")
);

$matakuliah = mysqli_query($conn, "SELECT * FROM tbmatakuliah ORDER BY nama_mk ASC");
$dosen      = mysqli_query($conn, "SELECT * FROM tbdosen ORDER BY nama_dosen ASC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Edit Jadwal</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{ background:#f4f6fb; }

.modal-box{
    max-width:650px;
    margin:80px auto;
    background:#fff;
    border-radius:8px;
    box-shadow:0 10px 30px rgba(0,0,0,.1);
}
.modal-header{
    border-bottom:1px solid #eee;
    padding:15px 20px;
    font-size:18px;
    font-weight:600;
    color:#2b4cff;
}
.modal-body{ padding:20px; }
.modal-footer{
    padding:15px 20px;
    border-top:1px solid #eee;
    text-align:right;
}
.form-label{ font-weight:500; }
</style>
</head>

<body>

<div class="modal-box">

    <div class="modal-header d-flex justify-content-between align-items-center">
        <span>Edit Jadwal Perwalian</span>
        <a href="index.php" class="text-dark text-decoration-none fs-5">&times;</a>
    </div>

    <form method="POST" action="update.php">

        <div class="modal-body">

            <input type="hidden" name="id_perwalian" value="<?= $data['id_perwalian']; ?>">

            <div class="mb-3">
                <label class="form-label">Hari</label>
                <select name="hari" class="form-select" required>
                    <?php
                    $hari = ["Senin","Selasa","Rabu","Kamis","Jumat","Sabtu"];
                    foreach ($hari as $h) {
                        $selected = ($data['hari'] == $h) ? "selected" : "";
                        echo "<option value='$h' $selected>$h</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Jam Mulai</label>
                    <input type="time"
                           name="jam_mulai"
                           class="form-control"
                           value="<?= $data['jam_mulai']; ?>"
                           required>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Jam Selesai</label>
                    <input type="time"
                           name="jam_selesai"
                           class="form-control"
                           value="<?= $data['jam_selesai']; ?>"
                           required>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Mata Kuliah</label>
                <select name="id_mk" class="form-select" required>
                    <?php while ($mk = mysqli_fetch_assoc($matakuliah)) : ?>
                        <option value="<?= $mk['id_mk']; ?>"
                            <?= ($data['id_mk'] == $mk['id_mk']) ? "selected" : ""; ?>>
                            <?= $mk['id_mk']; ?> - <?= $mk['nama_mk']; ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Dosen</label>
                <select name="nip" class="form-select" required>
                    <?php while ($d = mysqli_fetch_assoc($dosen)) : ?>
                        <option value="<?= $d['nip']; ?>"
                            <?= ($data['nip'] == $d['nip']) ? "selected" : ""; ?>>
                            <?= $d['nip']; ?> - <?= $d['nama_dosen']; ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Ruang</label>
                <input type="text"
                       name="ruang"
                       class="form-control"
                       value="<?= $data['ruang']; ?>"
                       required>
            </div>

        </div>

        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">
                Simpan
            </button>
            <a href="index.php" class="btn btn-secondary">
                Batal
            </a>
        </div>

    </form>

</div>

</body>
</html>
