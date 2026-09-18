<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once 'functions.php';

$msg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (loginUser($username, $password)) {
        header('Location: index.php');
        exit();
    } else {
        $msg = 'Username atau password salah!';
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login System</title>
    <style>
        body { font-family: Arial, sans-serif; background: #eef2f5; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .box { background: #fff; padding: 25px; border-radius: 8px; width: 300px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        input { width: 100%; padding: 8px; margin: 8px 0; box-sizing: border-box; }
        button { width: 100%; padding: 10px; background: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer; }
        .error { color: red; font-size: 13px; }
        .success { color: green; font-size: 13px; }
        a { text-decoration: none; color: #007bff; font-size: 13px; display: block; text-align: center; margin-top: 10px; }
    </style>
</head>
<body>
    <div class="box">
        <h2>Login System</h2>
        <?php if (isset($_GET['registered'])): ?>
            <p class="success">Registrasi berhasil! Silakan login.</p>
        <?php endif; ?>
        <?php if ($msg): ?>
            <p class="error"><?= $msg; ?></p>
        <?php endif; ?>
        <form method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
        <a href="register.php">Belum punya akun? Daftar</a>
    </div>
</body>
</html>