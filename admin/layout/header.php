<?php
session_start();
if(!isset($_SESSION['login'])){
    header("Location: ../login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Portal Admin</title>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

<style>
body {
    margin: 0;
    background-color: #f4f6f9;
}

/* Layout */
.wrapper {
    display: flex;
    min-height: 100vh;
}

/* Sidebar */
.sidebar {
    width: 230px;
    background-color: #344eb8;
    color: white;
    position: fixed;
    top: 0;
    bottom: 0;
}

.sidebar h4 {
    padding: 20px;
    margin: 0;
    font-size: 18px;
    border-bottom: 1px solid rgba(255,255,255,0.2);
}

.sidebar a {
    color: white;
    text-decoration: none;
    display: block;
    padding: 12px 20px;
}

.sidebar a:hover {
    background-color: rgba(255,255,255,0.2);
}

/* Main */
.main {
    margin-left: 230px;
    width: calc(100% - 230px);
    display: flex;
    flex-direction: column;
}

/* Header */
.topbar {
    height: 60px;
    background-color: #0c2d83;
    color: white;
    display: flex;
    justify-content: flex-end;
    align-items: center;
    padding: 0 20px;
}

.topbar .admin {
    display: flex;
    align-items: center;
    gap: 10px;
}

.topbar .avatar {
    width: 32px;
    height: 32px;
    background-color: white;
    border-radius: 50%;
}

/* Content */
.content {
    padding: 20px;
    flex: 1;
}
</style>
</head>
<body>

<div class="wrapper">
