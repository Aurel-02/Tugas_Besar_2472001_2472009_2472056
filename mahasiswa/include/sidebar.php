<?php

if (!isset($_SESSION['login']) || $_SESSION['role_id'] !== '3') {
    header("Location: /TUGAS_BESAR_2472001_2472009_2472056/login.php?role=3");
    exit;
}
?>

<aside class="sidebar d-flex flex-column justify-content-between">
    <div>
        <div class="sidebar-logo"></div>

        <hr class="sidebar-divider">

        <ul class="nav flex-column sidebar-menu">
            <li class="nav-item">
                <div class="icon nilai"></div>
                <span>Nilai</span>
            </li>

            <li class="nav-item">
                <div class="icon dkbs"></div>
                <span>DKBS</span>
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
