<?php
include "../../koneksi.php";
$prodi = mysqli_query($conn,"SELECT * FROM tbprodi ORDER BY id_prodi");
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Tambah Mahasiswa</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{ background:#f4f6fb; }
.modal-box{
    max-width:600px;
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
    <span>Tambah Mahasiswa</span>
    <a href="index.php" class="text-dark fs-5 text-decoration-none">&times;</a>
</div>

<form method="POST" action="simpan.php">
<div class="modal-body">

    <div class="mb-3">
        <label class="form-label">Nama Mahasiswa</label>
        <input type="text" name="nama" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Program Studi</label>
        <select name="id_prodi" class="form-select" required>
            <option value="">-- Pilih Prodi --</option>
            <?php while($p = mysqli_fetch_assoc($prodi)) { ?>
                <option value="<?= $p['id_prodi'] ?>">
                    <?= $p['id_prodi'] ?> - <?= $p['nama_prodi'] ?>
                </option>
            <?php } ?>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Angkatan</label>
        <input type="text" name="angkatan"
               class="form-control"
               placeholder="2024"
               maxlength="4"
               required>
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
