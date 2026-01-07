<?php

if (!isset($_SESSION['login']) || $_SESSION['role_id'] !== '2') {
    header("Location: /TUGAS_BESAR_2472001_2472009_2472056/login.php?role=2");
    exit;
}
?>

<aside class="sidebar d-flex flex-column justify-content-between">
    <div>
        <div class="sidebar-logo"></div>

        <hr class="sidebar-divider">

        <ul class="nav flex-column sidebar-menu">
           <li class="nav-item">
                <a href="/Tugas_Besar_2472001_2472009_2472056/mahasiswa/transkrip.php">
                    <div class="icon nilai"></div>
                    <span>Kelola Nilai</span>
                </a>
            </li>

            <li class="nav-item">
                <div class="icon jadwal"></div>
                <span>Jadwal</span>
            </li>
        </ul>
    </div>

    <a href="/TUGAS_BESAR_2472001_2472009_2472056/logout.php"
       class="logout d-flex align-items-center gap-2 text-decoration-none">
        <div class="logout-icon"></div>
        <span class="logout-text">Logout</span>
    </a>
</aside>
