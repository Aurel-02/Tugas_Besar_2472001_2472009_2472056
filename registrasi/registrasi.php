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

                <form class="mx-auto" style="max-width: 520px;">
                    <div class="mb-3">
                        <label class="form-label">Daftar sebagai</label>
                        <select class="form-select">
                            <option value="" selected disabled>Pilih Peran</option>
                            <option value="mahasiswa">Mahasiswa</option>
                            <option value="dosen">Dosen</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" placeholder="Nama Lengkap">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Jurusan</label>
                        <select class="form-select">
                            <option selected>Pilih jurusan disini</option>
                            <option>Informatika</option>
                            <option>Sistem Informasi</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Password</label>
                        <input type="password" class="form-control" placeholder="Password">
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
