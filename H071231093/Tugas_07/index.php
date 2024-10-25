<?php
session_start();
require 'conn.php';

// Cek apakah user sudah login
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

$role = $_SESSION['role'];

// Tambah Mahasiswa
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['create'])) {
    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $prodi = $_POST['prodi'];

    $sql = "INSERT INTO mahasiswa (nama, nim, prodi) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sss', $nama, $nim, $prodi);
    $stmt->execute();
}

// Update Mahasiswa
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $prodi = $_POST['prodi'];

    $sql = "UPDATE mahasiswa SET nama = ?, nim = ?, prodi = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sssi', $nama, $nim, $prodi, $id);
    $stmt->execute();
}

// Hapus Mahasiswa
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $sql = "DELETE FROM mahasiswa WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();
}

// Query untuk menampilkan semua data mahasiswa
$mahasiswa = $conn->query("SELECT * FROM mahasiswa");
?>

<!DOCTYPE html>
<html>
<head>
    <title>CRUD Mahasiswa</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
    body {
        font-family: 'Montserrat', sans-serif;
        background-color: lightcyan;
        margin: 0;
        padding: 0;
    }

    .container {
        display: flex;
        flex-direction: column;
        align-items: center;
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        width: 1200px;
        padding: 5px;
        margin-top: 40px;   
    }

    h2 {
        font-weight: bold;
    }

    th {
        text-align: center;
        vertical-align: middle;
    }

    .text-center-aksi {
        text-align: center;
        vertical-align: middle;
    }

    .logout-btn-container {
        display: flex;
        justify-content: center;
        margin-top: 20px;
        margin-bottom: 20px;
    }
    </style>
</head>

<body>
    <div class="container">
        <h2 class="my-2"><center>DATA MAHASISWA</center></h2>

        <table class="table mt-1 mb-1">
            <thead>
                <tr>
                    <th>NAMA</th>
                    <th>NIM</th>
                    <th>PROGRAM STUDI</th>
                    <?php if ($role == 'admin') : ?>
                    <th class="text-center-aksi">AKSI</style=>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $mahasiswa->fetch_assoc()) : ?>
                <tr>
                    <td><?= $row['nama'] ?></td>
                    <td><?= $row['nim'] ?></td>
                    <td><?= $row['prodi'] ?></td>
                    <?php if ($role == 'admin') : ?>
                    <td class="text-center-aksi">
                        <a href="edit.php?id=<?= $row['id']; ?>" class="btn btn-warning">
                            <img src="https://cdn-icons-png.flaticon.com/512/1828/1828859.png" alt="Edit" width="15"></a>
                        <a href="index.php?delete=<?= $row['id'] ?>" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus data ini?')">
                            <img src="https://cdn-icons-png.flaticon.com/512/1214/1214428.png" alt="Delete" width="15"></a>
                    </td>
                    <?php endif; ?>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <!-- Tampilkan tombol tambah mahasiswa jika role adalah admin -->
        <?php if ($role == 'admin') : ?>
        <a href="input.php" class="btn btn-success mb-2" width="20">Tambah</a>
        <?php endif; ?>
    </div>

    <div class="logout-btn-container">
        <a href="logout.php" class="btn btn-danger logout-btn">
            <img src="https://cdn-icons-png.flaticon.com/512/25/25694.png" alt="Logout" width="20">
        </a>
    </div>
</body>
</html>
