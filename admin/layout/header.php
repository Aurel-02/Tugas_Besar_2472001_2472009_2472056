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
<title>Admin Panel</title>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

<style>
body{margin:0}
.sidebar{
    width:240px;
    height:100vh;
    position:fixed;
    background:#1f2937;
    color:white;
    padding-top:20px;
}
.sidebar a{
    color:white;
    text-decoration:none;
    display:block;
    padding:10px 20px;
}
.sidebar a:hover{
    background:#374151;
}
.content{
    margin-left:240px;
    padding:20px;
}
</style>
</head>
<body>
