# UTS Web I — Pemesanan Kantin Kampus

## 1. Identitas
- **Nama:** Nayla Husna
- **NIM:** 25012072
- **Kelas:** 25M31
- **Program Studi:** D3 Manajemen Informatika
- **Kampus:** Politeknik Ganesha Medan

## 2. Deskripsi
Aplikasi pemesanan kantin berbasis PHP Native tanpa framework dan database. Data menu menggunakan array PHP, keranjang menggunakan session, dan kategori favorit menggunakan cookie.

## 3. Kebutuhan
- XAMPP (Apache dan PHP)
- Visual Studio Code
- Browser
- Git dan akun GitHub

## 4. Langkah Pengerjaan

**Tahap 1 — Persiapan**
1. Mengaktifkan Apache melalui XAMPP.
2. Membuat folder `uts-web1-25012072` di `C:\xampp\htdocs\`.
3. Membuka folder proyek di Visual Studio Code.

Screenshot: `01-persiapan.png`

**Tahap 2 — Membuat Struktur Proyek**
1. Membuat folder `assets`, `data`, `includes`, dan `dokumentasi/pengujian`.
2. Membuat file PHP sesuai struktur proyek.

Screenshot: `02-struktur-folder.png`

**Tahap 3 — Membuat Fitur Aplikasi**
1. Menyiapkan data menu dalam `data/menu.php`.
2. Membuat fungsi pendukung di `includes/fungsi.php`.
3. Membuat daftar menu, pencarian, dan kategori favorit di `index.php`.
4. Membuat validasi pesanan dan pengelolaan session di `proses.php`.
5. Membuat keranjang, subtotal, diskon, dan total akhir di `keranjang.php`.
6. Membuat tampilan aplikasi melalui `assets/style.css`.

Screenshot:
- `03-data-menu.png`
- `04-daftar-menu.png`
- `05-keranjang.png`

**Tahap 4 — Pengujian Aplikasi**
1. Menguji pencarian dan kategori favorit.
2. Menguji jumlah kosong dan jumlah tidak valid.
3. Menguji penambahan, penghapusan, dan pengosongan keranjang.
4. Menguji subtotal Rp49.000 dan Rp50.000.
5. Memastikan diskon 10% berlaku mulai subtotal Rp50.000.

Screenshot:
- `U03a-jumlah-kosong.png`
- `U08a-subtotal-49000.png`
- `U08b-subtotal-50000.png`

**Tahap 5 — Git dan GitHub**
1. Menginisialisasi Git pada folder proyek.
2. Menyimpan perubahan secara bertahap menggunakan commit.
3. Membuat minimal tujuh commit.
4. Menghubungkan repositori lokal ke GitHub.
5. Mengunggah proyek menggunakan `git push`.

Screenshot:
- `06-riwayat-commit.png`
- `07-repositori-github.png`

**Tahap 6 — Pemeriksaan Akhir**
1. Memastikan aplikasi berjalan melalui browser.
2. Memeriksa seluruh fitur dan hasil pengujian.
3. Memastikan dokumentasi dan screenshot tersimpan dengan benar.

Screenshot: `08-hasil-akhir.png`

## 5. Cara Menjalankan
1. Simpan proyek di `C:\xampp\htdocs\uts-web1-25012072\`.
2. Aktifkan Apache di XAMPP.
3. Buka browser dan akses:

   `http://localhost/uts-web1-25012072/`

## 6. Fitur Aplikasi
- Daftar menu dan pencarian menggunakan GET.
- Pemesanan menggunakan POST dengan validasi.
- Keranjang berbasis session dengan batas 10 porsi per menu.
- Hapus item dan kosongkan keranjang.
- Subtotal, diskon 10% untuk subtotal minimal Rp50.000, dan total akhir.
- PRG dan flash message.
- Cookie kategori favorit selama tujuh hari.

## 7. Dokumentasi
Catatan pengujian dan screenshot asli disimpan di folder `dokumentasi/pengujian/`. Setiap screenshot diberi nama sesuai ID pengujian dan digunakan sebagai bukti hasil aktual aplikasi.

## 8. Kesimpulan
Aplikasi ini menerapkan konsep dasar PHP Native, meliputi array, GET, POST, validasi, session, cookie, perhitungan transaksi, serta penggunaan Git dan GitHub. Pengujian dilakukan untuk memastikan fitur berjalan sesuai kebutuhan.