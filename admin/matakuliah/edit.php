<?php
include "../../koneksi.php";

$id = $_GET['id'];

/* ambil data mata kuliah */
$data = mysqli_fetch_assoc(
    mysqli_query($conn,"
        SELECT * FROM tbmatakuliah
        WHERE id_mk='$id'
    ")
);

/* ambil data prodi */
$prodi = mysqli_query($conn,"
    SELECT * FROM tbprodi
    ORDER BY nama_prodi ASC
");
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Edit Mata Kuliah</title>

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
        <span>Edit Mata Kuliah</span>
        <a href="index.php" class="text-dark text-decoration-none fs-5">&times;</a>
    </div>

    <form method="POST" action="update.php">

        <div class="modal-body">

            <!-- ID MK -->
            <input type="hidden" name="id_mk" value="<?= $data['id_mk']; ?>">

            <div class="mb-3">
                <label class="form-label">ID Mata Kuliah</label>
                <input type="text"
                       class="form-control"
                       value="<?= $data['id_mk']; ?>"
                       readonly>
            </div>

            <!-- NAMA MK -->
            <div class="mb-3">
                <label class="form-label">Nama Mata Kuliah</label>
                <input type="text"
                       name="nama_mk"
                       class="form-control"
                       value="<?= $data['nama_mk']; ?>"
                       required>
            </div>

            <!-- SKS -->
            <div class="mb-3">
                <label class="form-label">SKS</label>
                <select name="sks" class="form-select" required>
                    <option value="">-- Pilih SKS --</option>
                    <option value="1" <?= $data['sks']==1?'selected':''; ?>>1 SKS</option>
                    <option value="2" <?= $data['sks']==2?'selected':''; ?>>2 SKS</option>
                    <option value="3" <?= $data['sks']==3?'selected':''; ?>>3 SKS</option>
                    <option value="4" <?= $data['sks']==4?'selected':''; ?>>4 SKS</option>
                </select>
            </div>

            <!-- PRODI -->
            <div class="mb-3">
                <label class="form-label">Program Studi</label>
                <select name="id_prodi" class="form-select" required>

                    <option value="">-- Pilih Program Studi --</option>

                    <?php while ($p = mysqli_fetch_assoc($prodi)) : ?>
                        <option value="<?= $p['id_prodi']; ?>"
                            <?= $data['id_prodi'] == $p['id_prodi'] ? 'selected' : ''; ?>>
                            <?= $p['id_prodi']; ?> - <?= $p['nama_prodi']; ?>
                        </option>
                    <?php endwhile; ?>

                </select>
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
