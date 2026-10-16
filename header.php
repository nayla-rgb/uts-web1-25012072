<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
$judulHalaman = $judulHalaman ?? 'Pemesanan Kantin Kampus';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($judulHalaman) ?></title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
<header class="site-header">
    <h1>Pemesanan Kantin Kampus</h1>
    <nav>
        <a href="index.php">Daftar Menu</a>
        <a href="keranjang.php">Keranjang (<?= isset($_SESSION['keranjang']) ? array_sum($_SESSION['keranjang']) : 0 ?>)</a>
    </nav>
</header>
<main class="container">
<?php if (!empty($_SESSION['flash'])): ?>
    <div class="alert <?= e($_SESSION['flash']['jenis'] ?? 'info') ?>">
        <?= e($_SESSION['flash']['pesan'] ?? '') ?>
    </div>
    <?php unset($_SESSION['flash']); ?>
<?php endif; ?>
