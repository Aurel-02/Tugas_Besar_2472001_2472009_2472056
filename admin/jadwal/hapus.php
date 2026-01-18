<?php
include "../../koneksi.php";

$id = $_GET['id'];

/* hapus data perwalian */
mysqli_query(
    $conn,
    "DELETE FROM tbperwalian WHERE id_perwalian = '$id'"
);

/* kembali ke halaman index */
header("Location: index.php");
exit;
