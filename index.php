<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

require_once 'functions.php';

$products_file = 'products_data.json';
$products = [];

if (file_exists($products_file)) {
    $products = json_decode(file_get_contents($products_file), true) ?? [];
}

$totalNilaiAset = hitungTotalNilaiStok($products);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Product Information System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4 bg-light">
    <div class="container bg-white p-4 rounded shadow-sm">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Sistem Informasi Produk</h2>
            <div>
                <span class="me-3">Halo, <strong><?= htmlspecialchars($_SESSION['user']); ?></strong></span>
                <a href="logout.php" class="btn btn-outline-danger btn-sm">Logout</a>
            </div>
        </div>

        <!-- Tombol Tambah Produk -->
        <div class="mb-3 d-flex justify-content-between align-items-center">
            <a href="tambah_produk.php" class="btn btn-primary">+ Tambah Produk Baru</a>
        </div>

        <table class="table table-bordered align-middle">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nama Produk</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Deskripsi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $item): ?>
                    <tr class="<?= dapatkanWarnaBaris($item['stok']); ?>">
                        <td><?= $item['id']; ?></td>
                        <td><?= htmlspecialchars($item['nama']); ?></td>
                        <td><?= htmlspecialchars($item['kategori']); ?></td>
                        <td>Rp <?= number_format($item['harga'], 0, ',', '.'); ?></td>
                        <td>
                            <?= $item['stok']; ?>
                            <?php if ($item['stok'] < 3): ?>
                                <span class="badge bg-danger">Kritis</span>
                            <?php endif; ?>
                        </td>
                        <td><?= htmlspecialchars($item['deskripsi']); ?></td>
                        <td>
                            <a href="lihat_produk.php?id=<?= $item['id']; ?>" class="btn btn-info btn-sm text-white">Lihat</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="alert alert-info mt-3">
            <strong>Total Nilai Aset Gudang:</strong> 
            Rp <?= number_format($totalNilaiAset, 0, ',', '.'); ?>
        </div>
    </div>
</body>
</html>