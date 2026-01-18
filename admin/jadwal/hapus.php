<?php
include "../../koneksi.php";

$id = $_GET['id'];

mysqli_query(
    $conn,
    "DELETE FROM tbperwalian WHERE id_perwalian = '$id'"
);

header("Location: index.php");
exit;
