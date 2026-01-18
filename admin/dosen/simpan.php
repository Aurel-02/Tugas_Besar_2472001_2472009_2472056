<?php
include "../../koneksi.php";

$nip      = $_POST['nip'];
$nama     = $_POST['nama'];
$id_prodi = $_POST['id_prodi'];

mysqli_query($conn, "
    INSERT INTO tbdosen
    (nip, nama_dosen, id_prodi)
    VALUES
    ('$nip', '$nama', '$id_prodi')
");

header("Location: index.php");