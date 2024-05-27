<?php

namespace Database\Seeders;

use App\Models\Quote;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuotesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1; $i <= 5; $i++) {
            $product = DB::table('products')->find(rand(1, 5));
            if($product) {
                $quantity = rand(1, 10);
                $subtotal = ($product->unit_price + $product->unit_price) * $quantity;
                $vat      = $subtotal * ($product->vat_percentage/100);

                Quote::query()
                    ->updateOrCreate([
                        'user_id'     => rand(1, User::count()),
                        'admin_id'    => 1,
                        'invoice'     => generate_invoice($i),
                        'order_title' => fake()->sentence(),
                    ])
                    ->items()
                    ->updateOrCreate([
                        'product_id'  => $product->id,
                        'unit_price'  => $product->unit_price,
                        'setup_price' => $product->setup_price,
                        'quantity'    => $quantity,
                        'vat'         => $product->vat,
                        'vat_percentage'  => $product->vat_percentage,
                        'subtotal'    => $subtotal,
                        'total'       => $subtotal + $vat,
                    ]);
            }

        }
    }
}
