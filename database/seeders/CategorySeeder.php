<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Elektronik' => 'Perangkat elektronik seperti laptop, komputer, dan printer.',
            'Furniture' => 'Perabotan kantor seperti meja, kursi, dan lemari.',
            'Kendaraan' => 'Kendaraan operasional kantor.',
            'Mesin' => 'Mesin industri dan peralatan berat.',
            'Peralatan Kantor' => 'Alat tulis dan perlengkapan kantor lainnya.',
        ];

        foreach ($categories as $name => $description) {
            Category::firstOrCreate(
                ['name' => $name],
                ['description' => $description]
            );
        }
    }
}
