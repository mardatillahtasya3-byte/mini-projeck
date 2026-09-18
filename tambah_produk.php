<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

$msg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $kode_id = trim($_POST['kode_id'] ?? '');
    $nama = trim($_POST['nama'] ?? '');
    $kategori = trim($_POST['kategori'] ?? '');
    $harga = (int) ($_POST['harga'] ?? 0);
    $stok = (int) ($_POST['stok'] ?? 0);
    $deskripsi = trim($_POST['deskripsi'] ?? '');

    if (!empty($nama) && !empty($kategori) && $harga > 0) {
        $file = 'products_data.json';
        $products = [];

        if (file_exists($file)) {
            $products = json_decode(file_get_contents($file), true) ?? [];
        }

        // Gunakan Kode ID jika diisi, jika tidak jana ID nombor secara automatik
        $id = !empty($kode_id) ? $kode_id : (count($products) + 101);

        $new_product = [
            'id' => $id,
            'nama' => $nama,
            'kategori' => $kategori,
            'harga' => $harga,
            'stok' => $stok,
            'deskripsi' => $deskripsi
        ];

        $products[] = $new_product;
        file_put_contents($file, json_encode($products, JSON_PRETTY_PRINT));

        header('Location: index.php');
        exit();
    } else {
        $msg = 'Sila isi ruangan Nama, Kategori, dan Harga!';
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Produk Baru</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4 bg-light">
    <div class="container bg-white p-4 rounded shadow-sm" style="max-width: 600px;">
        <h3 class="mb-4">Tambah Produk Baru</h3>

        <?php if ($msg): ?>
            <div class="alert alert-danger"><?= $msg; ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Kode ID Produk</label>
                <input type="text" name="kode_id" class="form-control" placeholder="Contoh: PRD-003">
            </div>
            <div class="mb-3">
                <label class="form-label">Nama Produk *</label>
                <input type="text" name="nama" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Kategori *</label>
                <input type="text" name="kategori" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Harga (Rp) *</label>
                <input type="number" name="harga" class="form-control" min="0" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Jumlah Stok *</label>
                <input type="number" name="stok" class="form-control" min="0" value="0" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Deskripsi Singkat</label>
                <textarea name="deskripsi" class="form-control" rows="3"></textarea>
            </div>
            <div class="d-flex justify-content-between">
                <a href="index.php" class="btn btn-secondary">Batal / Kembali</a>
                <button type="submit" class="btn btn-primary">Simpan Produk</button>
            </div>
        </form>
    </div>
</body>
</html>