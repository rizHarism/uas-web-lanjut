<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            ['nama' => 'Mouse Logitech M185 Wireless', 'harga' => 125000, 'stock' => 30],
            ['nama' => 'Keyboard Mechanical Fantech MK853', 'harga' => 450000, 'stock' => 25],
            ['nama' => 'Monitor LG 24” Full HD IPS', 'harga' => 1750000, 'stock' => 15],
            ['nama' => 'Router TP-Link TL-WR840N', 'harga' => 230000, 'stock' => 40],
            ['nama' => 'Switch D-Link 8 Port Gigabit', 'harga' => 310000, 'stock' => 35],
            ['nama' => 'Access Point Ubiquiti UniFi AC Lite', 'harga' => 1050000, 'stock' => 12],
            ['nama' => 'Printer Canon PIXMA MG2570S', 'harga' => 725000, 'stock' => 18],
            ['nama' => 'USB Flash Drive 32GB SanDisk', 'harga' => 78000, 'stock' => 60],
            ['nama' => 'External Hard Drive 1TB WD', 'harga' => 875000, 'stock' => 10],
            ['nama' => 'CPU Intel Core i5 10400F', 'harga' => 2500000, 'stock' => 8],
            ['nama' => 'RAM DDR4 8GB 2666MHz', 'harga' => 420000, 'stock' => 22],
            ['nama' => 'Motherboard ASUS B460M-A', 'harga' => 1450000, 'stock' => 9],
            ['nama' => 'VGA Card GTX 1650 4GB', 'harga' => 2700000, 'stock' => 5],
            ['nama' => 'Casing Gaming RGB', 'harga' => 510000, 'stock' => 14],
            ['nama' => 'Power Supply 500W 80+', 'harga' => 460000, 'stock' => 16],
            ['nama' => 'LAN Tester Cable RJ45', 'harga' => 65000, 'stock' => 30],
            ['nama' => 'Crimping Tool RJ45', 'harga' => 85000, 'stock' => 20],
            ['nama' => 'Kabel LAN CAT6 10 Meter', 'harga' => 95000, 'stock' => 50],
            ['nama' => 'Modem Huawei 4G LTE', 'harga' => 690000, 'stock' => 11],
            ['nama' => 'Wireless USB Adapter TP-Link', 'harga' => 155000, 'stock' => 33],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
