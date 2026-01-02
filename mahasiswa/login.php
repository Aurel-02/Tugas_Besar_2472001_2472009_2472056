<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Login Mahasiswa</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <link rel="stylesheet" href="../css/include.css">
  <link rel="stylesheet" href="../css/login_mahasiswa.css">
</head>
<body>
<?php
session_start();
include __DIR__ . '/../koneksi.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $sql = "SELECT u.id, u.role_id, m.nama_mahasiswa, p.nama_prodi
            FROM tbUsers u
            JOIN tbMahasiswa m ON u.id = m.nrp
            JOIN tbProdi p ON m.id_prodi = p.id_prodi
            WHERE u.id = ? AND u.password = ? AND u.role_id = '3'";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $username, $password);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) === 1) {
        $user = mysqli_fetch_assoc($result);

        $_SESSION['login']   = true;
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role_id'] = $user['role_id'];
        $_SESSION['nama']    = $user['nama_mahasiswa'];
        $_SESSION['prodi'] = $user['nama_prodi'];

        header("Location: ../mahasiswa/dashboard.php");
        exit;
    } else {
        $error = "NRP atau Password salah!";
    }
}
?>
<div class="container-fluid vh-100">
  <div class="row h-100">

    <?php include __DIR__ . '/../include/include.php'; ?>

    <div class="col-md-6 d-flex justify-content-center align-items-center">
      <div class="login-box">

        <h3 class="title mb-2">Login Mahasiswa</h3>
        <p class="subtitle mb-4">
          Silakan masuk menggunakan NRP dan password Anda!
        </p>

        <?php if (isset($error)): ?>
          <div class="text-danger text-center fst-italic my-3">
            <?= $error ?>
          </div>
        <?php endif; ?>

        <form method="POST">

          <input type="text"
                 name="username"
                 class="form-control username mb-3"
                 placeholder="NRP"
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
