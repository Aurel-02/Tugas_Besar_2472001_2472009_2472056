<?php
include "../../koneksi.php";
$id = $_GET['id'];

$data = mysqli_fetch_assoc(
    mysqli_query($conn,"
        SELECT 
            dkbs.*, 
            d.nama_dosen 
        FROM tbdkbs dkbs
        JOIN tbdosen d ON dkbs.nip = d.nip
        WHERE dkbs.id_dkbs = '$id'
    ")
);

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
        <span>Edit Jadwal</span>
        <a href="index.php" class="text-dark text-decoration-none fs-5">&times;</a>
    </div>

    <form method="POST" action="update.php">
        <div class="modal-body">

            <input type="hidden" name="id_dkbs" value="<?= $data['id_dkbs'] ?>">

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Hari</label>
                    <input type="text" name="hari" class="form-control" value="<?= $data['hari'] ?>" required>
                </div>

                <div class="col-md-3 mb-3">
                    <label class="form-label">Jam Mulai</label>
                    <input type="time" name="jam_mulai" class="form-control" value="<?= $data['jam_mulai'] ?>" required>
                </div>

                <div class="col-md-3 mb-3">
                    <label class="form-label">Jam Selesai</label>
                    <input type="time" name="jam_selesai" class="form-control" value="<?= $data['jam_selesai'] ?>" required>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Mata Kuliah</label>
                <input type="text" name="nama_mk" class="form-control" value="<?= $data['nama_mk'] ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Dosen</label>
                <input type="text" name="nama_dosen" class="form-control" value="<?= $data['nama_dosen'] ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Ruang</label>
                <input type="text" name="ruang" class="form-control" value="<?= $data['ruang'] ?>" required>
            </div>

        </div>

        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="index.php" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>

</body>
</html>
