<?php

namespace Database\Seeders;

use App\Models\Asset;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class AssetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::all();

        if ($categories->isEmpty()) {
            $this->call(CategorySeeder::class);
            $categories = Category::all();
        }

        $assets = [
            [
                'name' => 'MacBook Pro M1 2020',
                'category' => 'Elektronik',
                'price' => 20000000,
                'status' => 'deployed',
                'date' => '2023-01-15'
            ],
            [
                'name' => 'Dell XPS 13',
                'category' => 'Elektronik',
                'price' => 18500000,
                'status' => 'available',
                'date' => '2023-02-10'
            ],
            [
                'name' => 'Printer Epson L3110',
                'category' => 'Elektronik',
                'price' => 2500000,
                'status' => 'deployed',
                'date' => '2023-03-05'
            ],
            [
                'name' => 'Kursi Kerja Ergonomis Indachi',
                'category' => 'Furniture',
                'price' => 1200000,
                'status' => 'deployed',
                'date' => '2022-11-20'
            ],
            [
                'name' => 'Meja Kantor Minimalis',
                'category' => 'Furniture',
                'price' => 1500000,
                'status' => 'available',
                'date' => '2022-12-01'
            ],
            [
                'name' => 'Toyota Avanza Veloz',
                'category' => 'Kendaraan',
                'price' => 250000000,
                'status' => 'deployed',
                'date' => '2021-08-15'
            ],
            [
                'name' => 'Honda Beat Street',
                'category' => 'Kendaraan',
                'price' => 17000000,
                'status' => 'available',
                'date' => '2022-05-10'
            ],
            [
                'name' => 'Proyektor Epson EB-X400',
                'category' => 'Elektronik',
                'price' => 5500000,
                'status' => 'available',
                'date' => '2023-04-12'
            ],
            [
                'name' => 'Lemari Arsip Besi',
                'category' => 'Furniture',
                'price' => 2800000,
                'status' => 'deployed',
                'date' => '2022-09-30'
            ],
            [
                'name' => 'AC Daikin 1PK',
                'category' => 'Elektronik',
                'price' => 4500000,
                'status' => 'deployed',
                'date' => '2023-06-20'
            ],
        ];

        foreach ($assets as $index => $item) {
            $category = $categories->where('name', $item['category'])->first();

            if ($category) {
                Asset::create([
                    'name' => $item['name'],
                    'asset_code' => 'AST-' . date('Y') . '-' . str_pad($index + 1, 4, '0', STR_PAD_LEFT),
                    'category_id' => $category->id,
                    'status' => $item['status'],
                    'purchase_date' => $item['date'],
                    'price' => $item['price'],
                    'useful_life' => 5, // Default 5 years
                    'residual_value' => $item['price'] * 0.1, // 10% residual value
                ]);
            }
        }
    }
}
