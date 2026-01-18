<?php
include "../../koneksi.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nrp               = $_POST['nrp'];
    $nama_mahasiswa    = $_POST['nama_mahasiswa'];
    $id_prodi          = $_POST['id_prodi'];
    $angkatan          = $_POST['angkatan'];
    $status_mhs        = $_POST['status_mhs'];
    $tempat_lahir      = $_POST['tempat_lahir'];
    $tgl_lahir         = $_POST['tgl_lahir'];
    $jenis_kelamin     = $_POST['jenis_kelamin'];
    $email             = $_POST['email'];
    $no_telp_mahasiswa = $_POST['no_telp_mahasiswa'];
    $alamat_mahasiswa  = $_POST['alamat_mahasiswa'];

    $nama_wali   = $_POST['nama_wali'];
    $email_wali  = $_POST['email_wali'];
    $no_telp_wali= $_POST['no_telp_wali'];
    $alamat_wali = $_POST['alamat_wali'];

    $id_user        = $_POST['id_user'] ?? null;
    $id_dosen_wali  = $_POST['id_dosen_wali'] ?? null;

    $stmt = $conn->prepare("
        UPDATE tbmahasiswa SET
            nama_mahasiswa=?,
            id_prodi=?,
            angkatan=?,
            status_mhs=?,
            tempat_lahir=?,
            tgl_lahir=?,
            jenis_kelamin=?,
            email=?,
            no_telp_mahasiswa=?,
            alamat_mahasiswa=?,
            nama_wali=?,
            email_wali=?,
            no_telp_wali=?,
            alamat_wali=?,
            id_user=?,
            id_dosen_wali=?
        WHERE nrp=?
    ");

    $stmt->bind_param(
        "sssssssssssssssss",
        $nama_mahasiswa,
        $id_prodi,
        $angkatan,
        $status_mhs,
        $tempat_lahir,
        $tgl_lahir,
        $jenis_kelamin,
        $email,
        $no_telp_mahasiswa,
        $alamat_mahasiswa,
        $nama_wali,
        $email_wali,
        $no_telp_wali,
        $alamat_wali,
        $id_user,
        $id_dosen_wali,
        $nrp
    );

    $stmt->execute();
    $stmt->close();

    header("Location: index.php?status=update_success");
    exit;
}
