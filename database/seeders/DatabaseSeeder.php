<?php

namespace Database\Seeders;

use App\Models\Pelanggan;
use App\Models\Produk;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
        ]);

        // Create sample products
        $produk = [
            ['nama_produk' => 'Laptop ASUS', 'harga' => 8500000, 'stok' => 10],
            ['nama_produk' => 'Mouse Logitech', 'harga' => 150000, 'stok' => 50],
            ['nama_produk' => 'Keyboard Mechanical', 'harga' => 450000, 'stok' => 25],
            ['nama_produk' => 'Monitor 24 inch', 'harga' => 2100000, 'stok' => 15],
            ['nama_produk' => 'Headset Gaming', 'harga' => 350000, 'stok' => 30],
            ['nama_produk' => 'Webcam HD', 'harga' => 280000, 'stok' => 20],
            ['nama_produk' => 'USB Flashdisk 32GB', 'harga' => 75000, 'stok' => 100],
            ['nama_produk' => 'Harddisk External 1TB', 'harga' => 650000, 'stok' => 12],
        ];

        foreach ($produk as $p) {
            Produk::create($p);
        }

        // Create sample customers
        $pelanggan = [
            ['nama_pelanggan' => 'Budi Santoso', 'alamat' => 'Jl. Merdeka No. 1, Jakarta', 'nomor_telepon' => '08123456789'],
            ['nama_pelanggan' => 'Ani Wijaya', 'alamat' => 'Jl. Sudirman No. 23, Bandung', 'nomor_telepon' => '08234567890'],
            ['nama_pelanggan' => 'Citra Dewi', 'alamat' => 'Jl. Gatot Subroto No. 45, Surabaya', 'nomor_telepon' => '08345678901'],
            ['nama_pelanggan' => 'Dedi Kurniawan', 'alamat' => 'Jl. Ahmad Yani No. 67, Medan', 'nomor_telepon' => '08456789012'],
            ['nama_pelanggan' => 'Eka Putri', 'alamat' => 'Jl. Pemuda No. 89, Yogyakarta', 'nomor_telepon' => '08567890123'],
        ];

        foreach ($pelanggan as $p) {
            Pelanggan::create($p);
        }
    }
}
