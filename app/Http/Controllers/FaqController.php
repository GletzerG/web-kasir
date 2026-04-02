<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = [

            // ── Pelanggan ─────────────────────────────────────────
            [
                'kategori' => 'pelanggan',
                'pertanyaan' => 'Bagaimana cara menambahkan pelanggan baru?',
                'jawaban' => 'Buka menu Pelanggan di sidebar, lalu klik tombol Tambah Pelanggan. Isi nama, nomor telepon, dan data lain yang diperlukan, kemudian simpan.',
                'poin' => [],
            ],
            [
                'kategori' => 'pelanggan',
                'pertanyaan' => 'Bisakah data pelanggan diedit setelah disimpan?',
                'jawaban' => 'Ya. Temukan pelanggan di daftar, klik tombol Edit, ubah data yang perlu diperbarui, lalu klik Update Pelanggan.',
                'poin' => [],
            ],
            [
                'kategori' => 'pelanggan',
                'pertanyaan' => 'Apakah pelanggan yang sudah bertransaksi bisa dihapus?',
                'jawaban' => 'Tidak bisa langsung dihapus jika sudah memiliki riwayat transaksi, demi menjaga integritas data laporan.',
                'poin' => [],
            ],
            [
                'kategori' => 'pelanggan',
                'pertanyaan' => 'Apakah pengisian pelanggan wajib saat mencatat transaksi?',
                'jawaban' => 'Tidak. Kolom pelanggan bersifat opsional. Transaksi tetap bisa disimpan tanpa memilih pelanggan untuk penjualan tunai tanpa identitas.',
                'poin' => [],
            ],

            // ── Produk ────────────────────────────────────────────
            [
                'kategori' => 'produk',
                'pertanyaan' => 'Bagaimana cara menambahkan produk baru?',
                'jawaban' => 'Masuk ke menu Produk, klik Tambah Produk. Isi nama produk, harga, stok, dan upload gambar (opsional), lalu klik Simpan.',
                'poin' => [],
            ],
            [
                'kategori' => 'produk',
                'pertanyaan' => 'Format gambar apa saja yang didukung untuk produk?',
                'jawaban' => 'Sistem mendukung format berikut dengan ukuran maksimal 2MB per file:',
                'poin' => ['JPG / JPEG', 'PNG'],
            ],
            [
                'kategori' => 'produk',
                'pertanyaan' => 'Kenapa produk dengan stok 0 tidak bisa dipilih saat transaksi?',
                'jawaban' => 'Produk yang stoknya habis otomatis tidak bisa ditambahkan ke keranjang untuk mencegah penjualan melebihi ketersediaan barang. Perbarui stok terlebih dahulu di menu Edit Produk.',
                'poin' => [],
            ],
            [
                'kategori' => 'produk',
                'pertanyaan' => 'Bisakah menghapus banyak produk sekaligus?',
                'jawaban' => 'Ya. Di halaman Produk, centang produk yang ingin dihapus menggunakan checkbox, lalu klik tombol Hapus Terpilih yang muncul di bagian atas tabel.',
                'poin' => [],
            ],
            [
                'kategori' => 'produk',
                'pertanyaan' => 'Apa arti warna badge stok pada tabel produk?',
                'jawaban' => 'Warna badge menunjukkan kondisi stok produk saat ini:',
                'poin' => [
                    'Biru / Cyan — stok masih banyak (lebih dari 10)',
                    'Kuning — stok menipis (1 sampai 10)',
                    'Merah — stok habis (0)',
                ],
            ],

            // ── Transaksi ─────────────────────────────────────────
            [
                'kategori' => 'transaksi',
                'pertanyaan' => 'Bagaimana cara mencatat transaksi penjualan baru?',
                'jawaban' => 'Buka menu Penjualan, klik Catat Transaksi. Pilih produk dari grid katalog, atur jumlah di keranjang, pilih pelanggan (opsional), tentukan tanggal, lalu klik Simpan Transaksi.',
                'poin' => [],
            ],
            [
                'kategori' => 'transaksi',
                'pertanyaan' => 'Apa yang terjadi pada stok produk setelah transaksi disimpan?',
                'jawaban' => 'Stok akan otomatis berkurang sesuai jumlah produk yang terjual. Jika transaksi dihapus, stok akan dikembalikan ke jumlah semula.',
                'poin' => [],
            ],
            [
                'kategori' => 'transaksi',
                'pertanyaan' => 'Bisakah transaksi yang sudah disimpan diedit?',
                'jawaban' => 'Saat ini sistem belum mendukung edit transaksi. Jika ada kesalahan, hapus transaksi tersebut lalu buat ulang transaksi yang benar.',
                'poin' => [],
            ],
            [
                'kategori' => 'transaksi',
                'pertanyaan' => 'Apa perbedaan status Lunas, Pending, dan Batal?',
                'jawaban' => 'Setiap status memiliki arti berbeda:',
                'poin' => [
                    'Lunas — pembayaran sudah diterima penuh.',
                    'Pending — transaksi belum diselesaikan / menunggu pembayaran.',
                    'Batal — transaksi dibatalkan dan tidak dihitung sebagai penjualan.',
                ],
            ],
            [
                'kategori' => 'transaksi',
                'pertanyaan' => 'Bagaimana cara memfilter riwayat transaksi berdasarkan tanggal?',
                'jawaban' => 'Di halaman Penjualan, gunakan kolom Dari Tanggal dan Sampai Tanggal di bagian filter untuk menyaring transaksi sesuai rentang waktu yang diinginkan.',
                'poin' => [],
            ],

            // ── Akun ──────────────────────────────────────────────
            [
                'kategori' => 'akun',
                'pertanyaan' => 'Bagaimana cara mengganti password akun?',
                'jawaban' => 'Klik nama pengguna di pojok kanan atas, pilih Pengaturan Akun, lalu masuk ke tab Keamanan untuk mengubah password.',
                'poin' => [],
            ],
            [
                'kategori' => 'akun',
                'pertanyaan' => 'Apakah ada fitur multi-pengguna / multi-kasir?',
                'jawaban' => 'Ya. Admin dapat menambahkan akun kasir tambahan. Setiap transaksi akan tercatat atas nama kasir yang sedang login.',
                'poin' => [],
            ],
            [
                'kategori' => 'akun',
                'pertanyaan' => 'Bagaimana cara mengaktifkan atau menonaktifkan mode gelap?',
                'jawaban' => 'Klik ikon matahari atau bulan di bagian atas halaman untuk beralih antara mode terang dan gelap. Preferensi ini tersimpan otomatis di browser.',
                'poin' => [],
            ],

        ];

        return view('faq.index', compact('faqs'));
    }
}