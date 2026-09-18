<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

$id = $_GET['id'] ?? null;
$product = null;

if ($id) {
    $file = 'products_data.json';
    if (file_exists($file)) {
        $products = json_decode(file_get_contents($file), true) ?? [];
        foreach ($products as $item) {
            if ($item['id'] == $id) {
                $product = $item;
                break;
            }
        }
    }
}

if (!$product) {
    echo "<h3>Produk tidak ditemukan!</h3><a href='index.php'>Kembali ke Dashboard</a>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Produk - <?= htmlspecialchars($product['nama']); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4 bg-light">
    <div class="container bg-white p-4 rounded shadow-sm" style="max-width: 600px;">
        <h3 class="mb-3">Rincian Informasi Produk</h3>
        <hr>

        <table class="table table-borderless">
            <tr>
                <th width="30%">ID Produk</th>
                <td>: <?= $product['id']; ?></td>
            </tr>
            <tr>
                <th>Nama Produk</th>
                <td>: <?= htmlspecialchars($product['nama']); ?></td>
            </tr>
            <tr>
                <th>Kategori</th>
                <td>: <?= htmlspecialchars($product['kategori']); ?></td>
            </tr>
            <tr>
                <th>Harga</th>
                <td>: Rp <?= number_format($product['harga'], 0, ',', '.'); ?></td>
            </tr>
            <tr>
                <th>Jumlah Stok</th>
                <td>: 
                    <?= $product['stok']; ?>
                    <?php if ($product['stok'] < 3): ?>
                        <span class="badge bg-danger ms-2">Kritis</span>
                    <?php endif; ?>
                </td>
            </tr>
            <tr>
                <th>Deskripsi</th>
                <td>: <?= htmlspecialchars($product['deskripsi']); ?></td>
            </tr>
        </table>

        <div class="mt-4">
            <a href="index.php" class="btn btn-primary">Kembali ke Dashboard</a>
        </div>
    </div>
</body>
</html>