<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Login Dosen</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
   <link rel="stylesheet" href="../css/include.css">
  <link rel="stylesheet" href="../css/login_dosen.css">
</head>
<body>

<?php
session_start();
include __DIR__ . '/../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT id, role_id
            FROM tbUsers
            WHERE id = ?
              AND password = ?
              AND role_id = '2'"; 

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $username, $password);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) === 1) {
        $user = mysqli_fetch_assoc($result);

        $_SESSION['login'] = true;
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role_id'] = $user['role_id'];

        header("Location: dashboard.php");
        exit;
    } else {
        $error = "NIP atau Password salah!";
    }
}
?>

<div class="container-fluid vh-100">
  <div class="row h-100">

    <div class="col-md-6 left-panel logo-section d-flex justify-content-center align-items-center">
      <div class="logo text-center">
        <img src="../img/Logo_Maranatha.png"
            alt="Logo Kampus"
            class="logo-img mb-3">
      </div>
    </div>

    <div class="col-md-6 d-flex justify-content-center align-items-center">
      <div class="login-box">

        <h3 class="title mb-2">Login Dosen</h3>
        <p class="subtitle mb-4">
          Silakan masuk menggunakan NIP dan password Anda!
        </p>

        <?php if (isset($error)): ?>
          <div class="text-danger text-center mb-3 fst-italic">
            <?= $error ?>
          </div>
        <?php endif; ?>

        <form method="POST">
          <input type="text"
                 name="username"
                 class="form-control username mb-3"
                 placeholder="NIP"
                 required>

          <input type="password"
                 name="password"
                 class="form-control password mb-3"
                 placeholder="Password"
                 required>

          <div class="text-end mb-4">
            <a href="#" class="forgot">Lupa password?</a>
          </div>

          <button type="submit" class="btn btn-login w-100">
            Login
          </button>
        </form>

      </div>
    </div>

  </div>
</div>

</body>
</html>
