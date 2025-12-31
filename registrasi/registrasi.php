<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Registrasi | Universitas Kristen Maranatha</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/registrasi.css">
</head>
<body>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    include __DIR__ . "/../koneksi.php";

    $nama     = $_POST['nama'];
    $id_prodi = $_POST['id_prodi'];
    $password = $_POST['password'];
    $role_id  = $_POST['role_id'];

    if ($role_id == '3') {
        $sql = "CALL sp_InsertUserMahasiswa(?, ?, ?)";
    } elseif ($role_id == '2') {
        $sql = "CALL sp_InsertDosen(?, ?, ?)";
    } else {
        die("Role tidak valid");
    }

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sss", $nama, $id_prodi, $password);

    if (!mysqli_stmt_execute($stmt)) {
        die("Error: " . mysqli_error($conn));
    }

    echo "<script>
        alert('Registrasi berhasil');
        window.location='../index.php';
    </script>";
}
?>

<div class="container-fluid min-vh-100">
    <div class="row min-vh-100">

        <div class="col-md-6 left-panel d-flex align-items-center justify-content-center">
            <img src="../img/Logo_Maranatha.png"
                 alt="Universitas Kristen Maranatha"
                 class="logo-maranatha">
        </div>

        <div class="col-md-6 bg-white d-flex align-items-center">
            <div class="form-wrapper w-100 px-5">

                <h2 class="fw-bold mb-4 text-center">Registrasi</h2>

                <form method="POST" class="mx-auto" style="max-width: 520px;">

                    <div class="mb-3">
                        <label class="form-label">Daftar sebagai</label>
                        <select class="form-select" name="role_id" required>
                            <option value="" selected disabled>Pilih Peran</option>
                            <option value="3">Mahasiswa</option>
                            <option value="2">Dosen</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text"
                               class="form-control"
                               name="nama"
                               placeholder="Nama Lengkap"
                               required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Jurusan</label>
                        <select class="form-select" name="id_prodi" required>
                            <option value="" selected disabled>Pilih jurusan disini</option>
                            <option value="01">Pendidikan Dokter</option>
                            <option value="02">Pendidikan Profesi Dokter</option>
                            <option value="21">Hukum</option>
                            <option value="22">Bisnis Digital</option>
                            <option value="23">Akuntansi</option>
                            <option value="41">Psikologi</option>
                            <option value="42">Profesi Psikologi</option>
                            <option value="51">Kedokteran Gigi</option>
                            <option value="52">Kedokteran Profesi Gigi</option>
                            <option value="55">Pertambangan</option>
                            <option value="61">Desain Komunikasi Visual</option>
                            <option value="62">Sastra Inggris</option>
                            <option value="63">Sastra Jepang</option>
                            <option value="64">Sastra China</option>
                            <option value="72">Teknik Informatika</option>
                            <option value="73">Sistem Informasi</option>
                            <option value="74">Teknik Elektro</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Password</label>
                        <input type="password"
                               class="form-control"
                               name="password"
                               placeholder="Password"
                               required>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-2">
                        Sign Up
                    </button>

                </form>

            </div>
        </div>

    </div>
</div>

</body>
</html>
