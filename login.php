<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Login</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/login.css">
</head>
<body>

<?php
    session_start();
    include __DIR__ . '/koneksi.php';

    $role = $_GET['role'] ?? '';

    if (!in_array($role, ['1','2','3'])) {
        header("Location: ../index.php");
        exit;
    }

    $judul = match ($role) {
        '1' => 'Login Admin',
        '2' => 'Login Dosen',
        '3' => 'Login Mahasiswa'
    };

    $error = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $username = trim($_POST['username']);
        $password = trim($_POST['password']);

        if ($role === '3') {
            $sql = "SELECT u.id, u.role_id, m.nama_mahasiswa AS nama, p.nama_prodi
                    FROM tbUsers u
                    JOIN tbMahasiswa m ON u.id = m.nrp
                    JOIN tbProdi p ON m.id_prodi = p.id_prodi
                    WHERE u.id = ? AND u.password = ? AND u.role_id = ?";
        } elseif ($role === '2') {
            $sql = "SELECT u.id, u.role_id, d.nama_dosen AS nama
                    FROM tbUsers u
                    JOIN tbDosen d ON u.id = d.nip
                    WHERE u.id = ? AND u.password = ? AND u.role_id = ?";
        } else {
            $sql = "SELECT id, role_id
                    FROM tbUsers
                    WHERE id = ? AND password = ? AND role_id = ?";
        }

        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "sss", $username, $password, $role);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) === 1) {
            $user = mysqli_fetch_assoc($result);

            $_SESSION['login']   = true;
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role_id'] = $user['role_id'];
            $_SESSION['nama']    = $user['nama'] ?? 'Admin';
            $_SESSION['prodi']   = $user['nama_prodi'] ?? '';

            if ($role == '1') {
                header("Location: admin/dashboard.php");
            } elseif ($role == '2') {
                header("Location: dosen/dashboard.php");
            } elseif ($role == '3') {
                header("Location: mahasiswa/dashboard.php");
            }
            exit;
        } else {
            $error = "Username / Password salah!";
        }
    }
    ?>

    <div class="container-fluid vh-100">
    <div class="row h-100">

        <div class="col-md-6 left-panel d-flex align-items-center justify-content-center">
            <img src="img/Logo_Maranatha.png" 
                alt="Universitas Kristen Maranatha"
                class="logo-maranatha">
        </div>

        <div class="col-md-6 d-flex justify-content-center align-items-center">
        <div class="login-box">

            <h3 class="title mb-2"><?= $judul ?></h3>
            <p class="subtitle mb-4">
            Silakan masuk menggunakan akun Anda
            </p>

            <?php if ($error): ?>
            <div class="text-danger text-center fst-italic my-3">
                <?= $error ?>
            </div>
            <?php endif; ?>

            <form method="POST">

            <input type="text"
                    name="username"
                    class="form-control mb-3"
                    placeholder="Username"
                    required>

            <input type="password"
                    name="password"
                    class="form-control mb-3"
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
