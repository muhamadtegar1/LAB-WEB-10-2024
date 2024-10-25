<?php
// Mulai session untuk mengecek role
session_start();

// Hubungkan ke database
include 'conn.php';

// Proses penambahan data mahasiswa jika form disubmit
$message = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $prodi = $_POST['prodi'];

    // Buat query untuk insert data mahasiswa
    $query = "INSERT INTO mahasiswa (nama, nim, prodi) VALUES ('$nama', '$nim', '$prodi')";

    // Eksekusi query
    if (mysqli_query($conn, $query)) {
        header("Location: index.php");
        exit;
    } else {
        $message = "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Mahasiswa</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: lightcyan;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 500px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2 class="my-2"><center>Tambah Data</center></h2>
        
        <!-- Pesan sukses atau error -->
        <?php if ($message) : ?>
            <div class="alert alert-info">
                <?= $message; ?>
            </div>
        <?php endif; ?>
        
        <?php if ($_SESSION['role'] == 'admin') : ?>
            <!-- Form tambah mahasiswa -->
            <form method="POST" action="input.php">
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" name="nama" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>NIM</label>
                    <input type="text" name="nim" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Prodi</label>
                    <input type="text" name="prodi" class="form-control" required>
                </div>
                <div style="display: flex; justify-content: center;">
                    <button type="submit" class="btn btn-success mb-2">Done</button>
                </div>
            </form>
        <?php endif; ?>
    </div>
</body>
</html>
