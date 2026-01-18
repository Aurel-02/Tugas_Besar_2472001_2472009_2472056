<?php
include "../../koneksi.php";

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = $_GET['id'];

$stmt = $conn->prepare("CALL sp_get_dosen_by_nip(?)");
$stmt->bind_param("s", $id);
$stmt->execute();

$result = $stmt->get_result();
$row = $result->fetch_assoc();

$stmt->close();
$conn->next_result();

if (!$row) {
    echo "Data dosen tidak ditemukan.";
    exit;
}

$prodi = mysqli_query($conn, "SELECT * FROM tbprodi ORDER BY nama_prodi ASC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Edit Dosen</title>

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
        <span>Edit Dosen</span>
        <a href="index.php" class="text-dark text-decoration-none fs-5">&times;</a>
    </div>

    <form method="POST" action="update.php">

        <div class="modal-body">

            <input type="hidden" name="nip" value="<?= $row['nip']; ?>">

            <div class="mb-3">
                <label class="form-label">NIP</label>
                <input type="text" class="form-control"
                       value="<?= $row['nip']; ?>" readonly>
            </div>

            <div class="mb-3">
                <label class="form-label">Nama Dosen</label>
                <input type="text" name="nama_dosen"
                       class="form-control"
                       value="<?= $row['nama_dosen']; ?>"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Program Studi</label>
                <select name="id_prodi" class="form-select" required>
                    <?php while($p = mysqli_fetch_assoc($prodi)) : ?>
                        <option value="<?= $p['id_prodi']; ?>"
                            <?= ($row['id_prodi'] == $p['id_prodi']) ? 'selected' : ''; ?>>
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
