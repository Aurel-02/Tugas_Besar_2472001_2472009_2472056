<?php
$conn = mysqli_connect("localhost", "root", "", "dbAkademik");


if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

$query = "SELECT * FROM tbMahasiswa";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Mahasiswa</title>
    <style>
        table {
            border-collapse: collapse;
            width: 80%;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #ddd;
        }
    </style>
</head>
<body>

<h2>Data Mahasiswa</h2>

<table>
    <tr>
        <th>NRP</th>
        <th>Nama</th>
        <th>Email</th>
    </tr>

    <?php while ($row = mysqli_fetch_assoc($result)) : ?>
    <tr>
        <td><?= $row['nrp']; ?></td>
        <td><?= $row['nama_mahasiswa']; ?></td>
        <td><?= $row['email']; ?></td>
    </tr>
    <?php endwhile; ?>

</table>

</body>
</html>
