<?php
require_once 'functions.php';

$msg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (!empty($username) && !empty($password)) {
        $file = 'users_data.json';
        $users = json_decode(file_get_contents($file), true) ?? [];

        // Cek apakah username sudah ada
        $exists = false;
        foreach ($users as $user) {
            if ($user['username'] === $username) {
                $exists = true;
                break;
            }
        }

        if ($exists) {
            $msg = 'Username sudah terdaftar!';
        } else {
            // Tambahkan user baru
            $users[] = [
                'username' => $username,
                'password' => $password
            ];
            file_put_contents($file, json_encode($users, JSON_PRETTY_PRINT));
            header('Location: login.php?registered=1');
            exit();
        }
    } else {
        $msg = 'Semua kolom wajib diisi!';
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Register System</title>
    <style>
        body { font-family: Arial, sans-serif; background: #eef2f5; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .box { background: #fff; padding: 25px; border-radius: 8px; width: 300px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        input { width: 100%; padding: 8px; margin: 8px 0; box-sizing: border-box; }
        button { width: 100%; padding: 10px; background: #28a745; color: #fff; border: none; border-radius: 4px; cursor: pointer; }
        .error { color: red; font-size: 13px; }
        a { text-decoration: none; color: #007bff; font-size: 13px; display: block; text-align: center; margin-top: 10px; }
    </style>
</head>
<body>
    <div class="box">
        <h2>Register System</h2>
        <?php if ($msg): ?>
            <p class="error"><?= $msg; ?></p>
        <?php endif; ?>
        <form method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Daftar</button>
        </form>
        <a href="login.php">Sudah punya akun? Login</a>
    </div>
</body>
</html>