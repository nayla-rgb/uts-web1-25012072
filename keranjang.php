<?php
session_start();
require_once __DIR__ . '/includes/fungsi.php';
require_once __DIR__ . '/data/menu.php';

if (!isset($_SESSION['keranjang']) || !is_array($_SESSION['keranjang'])) {
    $_SESSION['keranjang'] = [];
}

$keranjang = $_SESSION['keranjang'];
$subtotal = hitungSubtotalKeranjang($keranjang, $daftarMenu);
$diskon = hitungDiskon($subtotal);
$totalAkhir = hitungTotalAkhir($subtotal);

$judulHalaman = 'Keranjang Pesanan';
require __DIR__ . '/includes/header.php';
?>
<section class="panel">
    <h2>Keranjang Pesanan</h2>

    <?php if (empty($keranjang)): ?>
        <div class="alert info">Keranjang masih kosong. Silakan pilih menu terlebih dahulu.</div>
        <a class="button" href="index.php">Kembali ke Daftar Menu</a>
    <?php else: ?>
        <div class="table-wrap">
        <table>
            <thead><tr><th>Kode</th><th>Nama Menu</th><th>Harga</th><th>Jumlah</th><th>Subtotal</th><th>Aksi</th></tr></thead>
            <tbody>
            <?php foreach ($keranjang as $kode => $jumlah): ?>
                <?php if (!isset($daftarMenu[$kode])) continue; ?>
                <?php $menu = $daftarMenu[$kode]; $subtotalItem = hitungSubtotalItem($menu['harga'], (int)$jumlah); ?>
                <tr>
                    <td><?= e($kode) ?></td>
                    <td><?= e($menu['nama']) ?></td>
                    <td><?= rupiah($menu['harga']) ?></td>
                    <td><?= (int)$jumlah ?></td>
                    <td><?= rupiah($subtotalItem) ?></td>
                    <td>
                        <form method="post" action="proses.php" onsubmit="return confirm('Hapus item ini?')">
                            <input type="hidden" name="aksi" value="hapus">
                            <input type="hidden" name="kode" value="<?= e($kode) ?>">
                            <button class="danger" type="submit">Hapus</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        </div>

        <div class="summary">
            <p>Subtotal seluruh pesanan: <strong><?= rupiah($subtotal) ?></strong></p>
            <p>Diskon: <strong><?= rupiah($diskon) ?></strong> <?= $subtotal >= 50000? '(10%)' : '(subtotal belum mencapai Rp50.000)' ?></p>
            <p class="grand-total">Total akhir: <?= rupiah($totalAkhir) ?></p>
        </div>

        <div class="actions">
            <a class="button secondary" href="index.php">Tambah Menu</a>
            <form method="post" action="proses.php" onsubmit="return confirm('Kosongkan semua isi keranjang?')">
                <input type="hidden" name="aksi" value="kosongkan">
                <button class="danger" type="submit">Kosongkan Keranjang</button>
            </form>
        </div>
    <?php endif; ?>
</section>
<?php require __DIR__ . '/includes/footer.php'; ?>
