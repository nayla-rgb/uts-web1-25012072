<?php
declare(strict_types=1);

function e(mixed $nilai): string
{
    return htmlspecialchars((string)$nilai, ENT_QUOTES, 'UTF-8');
}

function rupiah(int|float $nilai): string
{
    return 'Rp' . number_format((float)$nilai, 0, ',', '.');
}

function hitungSubtotalItem(int|float $harga, int $jumlah): int
{
    return (int)$harga * $jumlah;
}

function hitungSubtotalKeranjang(array $keranjang, array $daftarMenu): int
{
    $subtotal = 0;
    foreach ($keranjang as $kode => $jumlah) {
        if (isset($daftarMenu[$kode])) {
            $subtotal += hitungSubtotalItem((int)$daftarMenu[$kode]['harga'], (int)$jumlah);
        }
    }
    return $subtotal;
}

function hitungDiskon(int $subtotal): int
{
    return $subtotal >= 50000 ? (int)round($subtotal * 0.10) : 0;
}

function hitungTotalAkhir(int $subtotal): int
{
    return $subtotal - hitungDiskon($subtotal);
}

function ambilKategori(array $daftarMenu): array
{
    $kategori = [];
    foreach ($daftarMenu as $menu) {
        if (!in_array($menu['kategori'], $kategori, true)) {
            $kategori[] = $menu['kategori'];
        }
    }
    sort($kategori);
    return $kategori;
}

function redirectKe(string $lokasi): never
{
    header('Location: ' . $lokasi);
    exit;
}
