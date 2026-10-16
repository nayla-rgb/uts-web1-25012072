<?php
session_start();
require_once __DIR__ . '/includes/fungsi.php';
require_once __DIR__ . '/data/menu.php';

if (!isset($_SESSION['keranjang']) || !is_array($_SESSION['keranjang'])) {
    $_SESSION['keranjang'] = [];
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirectKe('index.php');
}

$aksi = (string)($_POST['aksi'] ?? '');

if ($aksi === 'simpan_kategori') {
    $kategori = (string)($_POST['kategori'] ?? '');
    $kategoriTersedia = ambilKategori($daftarMenu);

    if (!in_array($kategori, $kategoriTersedia, true)) {
        $_SESSION['flash'] = ['jenis' => 'error', 'pesan' => 'Kategori tidak valid.'];
        redirectKe('index.php');
    }

    setcookie('kategori_favorit', $kategori, [
        'expires' => time() + (7 * 24 * 60 * 60),
        'path' => '/',
        'samesite' => 'Lax',
    ]);
    $_SESSION['flash'] = ['jenis' => 'success', 'pesan' => 'Kategori favorit berhasil disimpan selama 7 hari.'];
    redirectKe('index.php?kategori=' . rawurlencode($kategori));
}

if ($aksi === 'tambah') {
    $kode = (string)($_POST['kode'] ?? '');
    $jumlahInput = trim((string)($_POST['jumlah'] ?? ''));

    if (!isset($daftarMenu[$kode])) {
        $_SESSION['flash'] = ['jenis' => 'error', 'pesan' => 'Kode menu tidak dikenal. Keranjang tidak berubah.'];
        redirectKe('index.php');
    }

    
    if ($jumlahInput === '' || !preg_match('/^\d+$/', $jumlahInput)) {
        $_SESSION['flash'] = [
            'jenis' => 'error',
            'pesan' => 'Jumlah harus bilangan bulat antara 1 sampai 10. Keranjang tidak berubah.'
        ];
        redirectKe('index.php');
    }


    $jumlah = (int)$jumlahInput;
    if ($jumlah < 1 || $jumlah > 10) {
        $_SESSION['flash'] = ['jenis' => 'error', 'pesan' => 'Jumlah harus antara 1 sampai 10. Keranjang tidak berubah.'];
        redirectKe('index.php');
    }

    $jumlahLama = (int)($_SESSION['keranjang'][$kode] ?? 0);
    if ($jumlahLama + $jumlah > 10) {
        $_SESSION['flash'] = ['jenis' => 'error', 'pesan' => 'Jumlah menu ini maksimal 10. Keranjang tetap seperti sebelumnya.'];
        redirectKe('index.php');
    }

    $_SESSION['keranjang'][$kode] = $jumlahLama + $jumlah;
    $_SESSION['flash'] = ['jenis' => 'success', 'pesan' => $daftarMenu[$kode]['nama'] . ' berhasil ditambahkan ke keranjang.'];
    redirectKe('keranjang.php');
}

if ($aksi === 'hapus') {
    $kode = (string)($_POST['kode'] ?? '');
    if (isset($_SESSION['keranjang'][$kode])) {
        unset($_SESSION['keranjang'][$kode]);
        $_SESSION['flash'] = ['jenis' => 'success', 'pesan' => 'Item berhasil dihapus dari keranjang.'];
    } else {
        $_SESSION['flash'] = ['jenis' => 'error', 'pesan' => 'Item tidak ditemukan di keranjang.'];
    }
    redirectKe('keranjang.php');
}

if ($aksi === 'kosongkan') {
    $_SESSION['keranjang'] = [];
    $_SESSION['flash'] = ['jenis' => 'success', 'pesan' => 'Keranjang berhasil dikosongkan.'];
    redirectKe('keranjang.php');
}

$_SESSION['flash'] = ['jenis' => 'error', 'pesan' => 'Aksi tidak dikenali.'];
redirectKe('index.php');
