<?php
session_start();

session_unset();
session_destroy();

header("Location: ../Tugas_Besar_2472001_2472009_2472056/login.php");
exit;