<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            'Reusable Name Badge',
            'Metal Name Badge',
            'Industry Sectors',

            'Personalised Name Badge',
            'Name badge'
        ];

        foreach ($products as $product) {
            Product::query()->updateOrCreate([
                'name'        => $product,
                'sku_number'  => rand(1111, 99999),
                'ur_code'     => rand(1111, 99999),
                'unit_price'  => rand(20, 100),
                'setup_price' => rand(20, 100),
                'vat'         => ['yes','no'][rand(0,1)],
                'vat_percentage'  => 20
            ]);
        }
    }
}
