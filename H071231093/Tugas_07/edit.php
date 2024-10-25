<?php
include 'conn.php';
session_start();

// Cek jika user belum login
if (!isset($_SESSION['role'])) {
    header('Location: login.php');
    exit();
}

// Ambil ID dari URL dan cek apakah ada
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Ambil data mahasiswa berdasarkan ID
$sql = "SELECT * FROM mahasiswa WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

// Cek apakah data mahasiswa ditemukan
if (!$result || $result->num_rows === 0) {
    echo "Mahasiswa tidak ditemukan!";
    exit();
}

// Ambil data mahasiswa
$mahasiswa = $result->fetch_assoc();

// Jika form di-submit, update data mahasiswa
if (isset($_POST['update'])) {
    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $prodi = $_POST['prodi'];

    // Update data mahasiswa di database
    $sql = "UPDATE mahasiswa SET nama = ?, nim = ?, prodi = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $nama, $nim, $prodi, $id);
    
    if ($stmt->execute()) {
        header("Location: index.php?message=Data berhasil diupdate");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Mahasiswa</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
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
    <div class="container">
        <h2 class="my-2"><center>Edit Data</center></h2>
        <form method="POST">
            <div class="form-group">
                <label for="nama">Nama:</label>
                <input type="text" class="form-control" name="nama" value="<?php echo htmlspecialchars($mahasiswa['nama']); ?>" required>
            </div>
            <div class="form-group">
                <label for="nim">NIM:</label>
                <input type="text" class="form-control" name="nim" value="<?php echo htmlspecialchars($mahasiswa['nim']); ?>" required>
            </div>
            <div class="form-group">
                <label for="prodi">Prodi:</label>
                <input type="text" class="form-control" name="prodi" value="<?php echo htmlspecialchars($mahasiswa['prodi']); ?>" required>
            </div>
            <div style="display: flex; justify-content: center;">
                <button type="submit" name="update" class="btn btn-primary mb-2">Update</button>
                </div>
        </form>
    </div>
</body>
</html>