<?php
include "../../koneksi.php";

$id = $_GET['id'];

$data = mysqli_fetch_assoc(
    mysqli_query($conn,"SELECT * FROM tbmahasiswa WHERE nrp='$id'")
);

$prodi = mysqli_query($conn,"SELECT * FROM tbprodi ORDER BY id_prodi ASC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Edit Mahasiswa</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{ background:#f4f6fb; }

.modal-box{
    max-width:800px;
    margin:60px auto;
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
hr{ margin:25px 0; }
</style>
</head>

<body>

<div class="modal-box">

    <div class="modal-header d-flex justify-content-between align-items-center">
        <span>Edit Mahasiswa</span>
        <a href="index.php" class="text-dark text-decoration-none fs-5">&times;</a>
    </div>

    <form method="POST" action="update.php">

        <div class="modal-body">

            <input type="hidden" name="nrp" value="<?= $data['nrp']; ?>">

            <div class="mb-3">
                <label class="form-label">NRP</label>
                <input type="text" class="form-control"
                       value="<?= $data['nrp']; ?>" readonly>
            </div>

            <div class="mb-3">
                <label class="form-label">Nama Mahasiswa</label>
                <input type="text" name="nama_mahasiswa"
                       class="form-control"
                       value="<?= $data['nama_mahasiswa']; ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Program Studi</label>
                <select name="id_prodi" class="form-select" required>
                    <?php while($p = mysqli_fetch_assoc($prodi)) : ?>
                        <option value="<?= $p['id_prodi']; ?>"
                            <?= ($data['id_prodi']==$p['id_prodi'])?'selected':''; ?>>
                            <?= $p['id_prodi']; ?> - <?= $p['nama_prodi']; ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Angkatan</label>
                <input type="text" name="angkatan"
                       class="form-control"
                       value="<?= $data['angkatan']; ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Status Mahasiswa</label>
                <select name="status_mhs" class="form-select">
                    <option value="Aktif" <?= $data['status_mhs']=='Aktif'?'selected':'' ?>>Aktif</option>
                    <option value="Cuti" <?= $data['status_mhs']=='Cuti'?'selected':'' ?>>Cuti</option>
                    <option value="Lulus" <?= $data['status_mhs']=='Lulus'?'selected':'' ?>>Lulus</option>
                    <option value="Nonaktif" <?= $data['status_mhs']=='Nonaktif'?'selected':'' ?>>Nonaktif</option>
                </select>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Tempat Lahir</label>
                    <input type="text" name="tempat_lahir"
                           class="form-control"
                           value="<?= $data['tempat_lahir']; ?>">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Tanggal Lahir</label>
                    <input type="date" name="tgl_lahir"
                           class="form-control"
                           value="<?= $data['tgl_lahir']; ?>">
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Jenis Kelamin</label>
                <select name="jenis_kelamin" class="form-select">
                    <option value="L" <?= $data['jenis_kelamin']=='L'?'selected':'' ?>>Laki-laki</option>
                    <option value="P" <?= $data['jenis_kelamin']=='P'?'selected':'' ?>>Perempuan</option>
                </select>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Email Mahasiswa</label>
                    <input type="email" name="email"
                           class="form-control"
                           value="<?= $data['email']; ?>">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">No Telp Mahasiswa</label>
                    <input type="text" name="no_telp_mahasiswa"
                           class="form-control"
                           value="<?= $data['no_telp_mahasiswa']; ?>">
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Alamat Mahasiswa</label>
                <textarea name="alamat_mahasiswa"
                          class="form-control"
                          rows="2"><?= $data['alamat_mahasiswa']; ?></textarea>
            </div>

            <hr>
            <h6 class="fw-bold text-secondary">Data Wali</h6>

            <div class="mb-3">
                <label class="form-label">Nama Wali</label>
                <input type="text" name="nama_wali"
                       class="form-control"
                       value="<?= $data['nama_wali']; ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Email Wali</label>
                <input type="email" name="email_wali"
                       class="form-control"
                       value="<?= $data['email_wali']; ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">No Telp Wali</label>
                <input type="text" name="no_telp_wali"
                       class="form-control"
                       value="<?= $data['no_telp_wali']; ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Alamat Wali</label>
                <textarea name="alamat_wali"
                          class="form-control"
                          rows="2"><?= $data['alamat_wali']; ?></textarea>
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
