<?php
session_start();

$role = $_SESSION['role_id'] ?? '3';

session_unset();
session_destroy();

if ($role === '1') {
    header("Location: /TUGAS_BESAR_2472001_2472009_2472056/login.php?role=1");
} elseif ($role === '2') {
    header("Location: /TUGAS_BESAR_2472001_2472009_2472056/login.php?role=2");
} else {
    header("Location: /TUGAS_BESAR_2472001_2472009_2472056/login.php?role=3");
}

exit;
