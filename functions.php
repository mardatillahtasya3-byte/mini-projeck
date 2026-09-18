<?php
// Fungsi untuk autentikasi user
function loginUser($username, $password) {
    $file = 'users_data.json';
    
    if (!file_exists($file)) {
        return false;
    }

    $json_data = file_get_contents($file);
    $users = json_decode($json_data, true) ?? [];

    foreach ($users as $user) {
        if ($user['username'] === $username && $user['password'] === $password) {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $_SESSION['user'] = $username;
            return true;
        }
    }

    return false;
}

// Fungsi untuk menghitung total nilai inventaris stok
function hitungTotalNilaiStok($products) {
    $total = 0;
    foreach ($products as $product) {
        $total += $product['harga'] * $product['stok'];
    }
    return $total;
}

// Fungsi menentukan kelas warna untuk stok kritis
function dapatkanWarnaBaris($stok) {
    if ($stok < 3) {
        return 'table-danger';
    }
    return '';
}
?>