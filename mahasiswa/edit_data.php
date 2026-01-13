<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Diri</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/edit_data.css">
</head>
<body>

<div class="top-header">
    <a href="profile.php" class="back-btn"><</a>
    <span>Edit Data diri</span>
</div>


<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="form-wrapper">
                <h5 class="text-center mb-4">Lengkapi data diri Anda</h5>

                <form action="update_profile.php" method="POST">

                    <label>Nama Lengkap Mahasiswa</label>
                    <input type="text" class="form-control" name="nama_mahasiswa">

                    <label>Tanggal Lahir Mahasiswa</label>
                    <input type="date" class="form-control" name="tgl_lahir">

                    <label>Alamat Mahasiswa</label>
                    <input type="text" class="form-control" name="alamat">

                    <label>Email Mahasiswa</label>
                    <input type="email" class="form-control" name="email">

                    <label>No. Telp Mahasiswa</label>
                    <input type="text" class="form-control" name="no_telp_mahasiswa">

                    <label class="mt-3">Jenis Kelamin</label>
                    <div class="gender">
                        <label><input type="radio" name="jenis_kelamin" value="Perempuan"> Perempuan</label>
                        <label><input type="radio" name="jenis_kelamin" value="Laki-laki"> Laki-laki</label>
                    </div>

                    <hr>

                    <label>Nama Lengkap Wali</label>
                    <input type="text" class="form-control" name="nama_wali">

                    <label>No. Telp Wali</label>
                    <input type="text" class="form-control" name="no_telp_wali">

                    <label>Alamat Wali</label>
                    <input type="text" class="form-control" name="alamat_wali">

                    <label>Email Wali</label>
                    <input type="email" class="form-control">

                    <div class="text-center mt-4">
                        <button type="submit" class="btn-submit">Submit</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>
