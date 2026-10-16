<?php
session_start();
require_once __DIR__ . '/includes/fungsi.php';
require_once __DIR__ . '/data/menu.php';

if (!isset($_SESSION['keranjang']) || !is_array($_SESSION['keranjang'])) {
    $_SESSION['keranjang'] = [];
}

$kategoriTersedia = ambilKategori($daftarMenu);
$kategoriCookie = $_COOKIE['kategori_favorit'] ?? '';
$kategoriGetAda = array_key_exists('kategori', $_GET);
$kategoriDiminta = $kategoriGetAda ? (string)$_GET['kategori'] : (string)$kategoriCookie;
if (!in_array($kategoriDiminta, $kategoriTersedia, true)) {
    $kategoriDiminta = '';
}

$cari = trim((string)($_GET['cari'] ?? ''));
$hasilMenu = [];
foreach ($daftarMenu as $menu) {
    $cocokNama = $cari === '' || stripos($menu['nama'], $cari) !== false;
    $cocokKategori = $kategoriDiminta === '' || $menu['kategori'] === $kategoriDiminta;
    if ($cocokNama && $cocokKategori) {
        $hasilMenu[] = $menu;
    }
}

$judulHalaman = 'Daftar Menu';
require __DIR__ . '/includes/header.php';
?>
<section class="panel">
    <h2>Daftar Menu Kantin</h2>
    <form method="get" action="index.php" class="search-form">
        <label for="cari">Cari nama menu</label>
        <input id="cari" type="text" name="cari" value="<?= e($cari) ?>" placeholder="Contoh: nasi goreng">
        <?php if ($kategoriDiminta !== ''): ?>
            <input type="hidden" name="kategori" value="<?= e($kategoriDiminta) ?>">
        <?php endif; ?>
        <button type="submit">Cari</button>
        <a class="button secondary" href="index.php">Reset</a>
    </form>

    <form method="post" action="proses.php" class="category-form">
        <input type="hidden" name="aksi" value="simpan_kategori">
        <label for="kategori">Kategori favorit (cookie 7 hari)</label>
        <select name="kategori" id="kategori" required>
            <option value="">-- Pilih kategori --</option>
            <?php foreach ($kategoriTersedia as $kategori): ?>
                <option value="<?= e($kategori) ?>" <?= $kategoriDiminta === $kategori ? 'selected' : '' ?>>
                    <?= e($kategori) ?>
                </option>
            <?php endforeach; ?>
        </select>
        <button type="submit">Simpan Favorit</button>
        <a class="button secondary" href="index.php">Lihat Semua</a>
    </form>

    <?php if ($cari !== ''): ?>
        <p>Hasil pencarian untuk: <strong><?= e($cari) ?></strong></p>
    <?php endif; ?>
    <?php if ($kategoriDiminta !== ''): ?>
        <p>Filter kategori: <strong><?= e($kategoriDiminta) ?></strong></p>
    <?php endif; ?>

    <?php if (count($hasilMenu) === 0): ?>
        <div class="alert warning">Menu tidak ditemukan. Coba kata kunci atau kategori lain.</div>
    <?php else: ?>
        <div class="table-wrap">
        <table>
            <thead><tr><th>Kode</th><th>Nama Menu</th><th>Kategori</th><th>Harga</th><th>Pesan</th></tr></thead>
            <tbody>
            <?php foreach ($hasilMenu as $menu): ?>
                <tr>
                    <td><?= e($menu['kode']) ?></td>
                    <td><?= e($menu['nama']) ?></td>
                    <td><?= e($menu['kategori']) ?></td>
                    <td><?= rupiah($menu['harga']) ?></td>
                    <td>
                        <form method="post" action="proses.php" class="order-form">
                            <input type="hidden" name="aksi" value="tambah">
                            <input type="hidden" name="kode" value="<?= e($menu['kode']) ?>">
                            <label class="sr-only" for="jumlah-<?= e($menu['kode']) ?>">Jumlah <?= e($menu['nama']) ?></label>
                            <input id="jumlah-<?= e($menu['kode']) ?>" type="number" name="jumlah" min="1" max="10" step="1" placeholder=" Masukan Jumlah">
                            <button type="submit">Tambah</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        </div>
    <?php endif; ?>
</section>
<?php require __DIR__ . '/includes/footer.php'; ?>
