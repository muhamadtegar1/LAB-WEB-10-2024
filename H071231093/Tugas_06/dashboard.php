<?php
session_start();

header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 

// Jika user tidak terdaftar maka harus login dulu
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

$user = $_SESSION['user'];

// contoh data
$users = [
    [
        'email' => 'admin@gmail.com',
        'username' => 'adminxxx',
        'name' => 'Admin',
        'password' => password_hash('admin123', PASSWORD_DEFAULT),
    ],
    [
        'email' => 'tegar@gmail.com',
        'username' => 'initegar',
        'name' => 'Muh. Tegar Adyaksa',
        'password' => password_hash('tegar123', PASSWORD_DEFAULT),
        'gender' => 'Him',
        'faculty' => 'MIPA',
        'batch' => '2023',
    ],
    [
        'email' => 'arif@gmail.com',
        'username' => 'arif_nich',
        'name' => 'Muhammad Arief',
        'password' => password_hash('arief123', PASSWORD_DEFAULT),
        'gender' => 'Male',
        'faculty' => 'Hukum',
        'batch' => '2021',
    ],
    [
        'email' => 'eka@gmail.com',
        'username' => 'eka59',
        'name' => 'Eka Hanny',
        'password' => password_hash('eka123', PASSWORD_DEFAULT),
        'gender' => 'Female',
        'faculty' => 'Keperawatan',
        'batch' => '2021',
    ],
    [
        'email' => 'adnan@gmail.com',
        'username' => 'adnan72',
        'name' => 'Adnan',
        'password' => password_hash('adnan123', PASSWORD_DEFAULT),
        'gender' => 'Male',
        'faculty' => 'Teknik',
        'batch' => '2020',
    ]
];

// Fungsi logout
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: login.php");
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>
    <?php if ($user['username'] === 'adminxxx'): ?>
        <div class="table">
        <h3>All Users</h3>
        <table>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Username</th>
                <th>Gender</th>
                <th>Faculty</th>
                <th>Batch</th>
            </tr>
            <?php foreach ($users as $u): ?>
                <tr>
                    <td><?php echo $u['name']; ?></td>
                    <td><?php echo $u['email']; ?></td>
                    <td><?php echo $u['username']; ?></td>
                    <td><?php echo $u['gender'] ?? ''; ?></td>
                    <td><?php echo $u['faculty'] ?? ''; ?></td>
                    <td><?php echo $u['batch'] ?? ''; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
    <?php else: ?>     
    <div class="container">
    <h2>Welcome, <?php echo $user['name']; ?>!</h2>
    <div class="user-info">
        <p><strong>Email:</strong> <?php echo $user['email']; ?></p>
        <p><strong>Username:</strong> <?php echo $user['username']; ?></p>
        <p><strong>Gender:</strong> <?php echo $user['gender']; ?></p>
        <p><strong>Faculty:</strong> <?php echo $user['faculty']; ?></p>
        <p><strong>Batch:</strong> <?php echo $user['batch']; ?></p>
    </div>
    <?php endif; ?>
    <a href="dashboard.php?logout=1"><button>Logout</button></a>
</body>
</html>
