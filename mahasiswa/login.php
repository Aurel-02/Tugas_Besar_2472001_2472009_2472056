<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Login Mahasiswa</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <link rel="stylesheet" href="login_mahasiswa.css">
</head>
<body>

<div class="container-fluid vh-100">
  <div class="row h-100">
    <div class="col-md-6 logo-section d-flex justify-content-center align-items-center">
      <div class="logo text-center">
        <img src=".../img/Logo_Maranatha.png" alt="Logo Kampus" class="logo-img mb-3">
      </div>
    </div>

    <div class="col-md-6 d-flex justify-content-center align-items-center">
      <div class="login-box">
        <h3 class="title mb-2">Login Mahasiswa</h3>
        <p class="subtitle mb-4">
          Silakan masuk menggunakan NRP dan password Anda!
        </p>

        <input type="text" class="form-control username mb-3" placeholder="Username">
        <input type="password" class="form-control password mb-2" placeholder="Password">

        <div class="text-end mb-4">
          <a href="#" class="forgot">Lupa password?</a>
        </div>

        <button class="btn btn-login w-100">Login</button>
      </div>
    </div>

  </div>
</div>

</body>
</html>
