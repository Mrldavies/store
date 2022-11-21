<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Product;

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
            [
                'sku' => 'SKU-0001',
                'name' => 'Product 1',
                'price' => '69.99'
            ],
            [
                'sku' => 'SKU-0002',
                'name' => 'Product 2',
                'price' => '4.20'
            ],
            [
                'sku' => 'SKU-0003',
                'name' => 'Product 3',
                'price' => '6.90'
            ],
            [
                'sku' => 'SKU-0004',
                'name' => 'Product 4',
                'price' => '42.00'
            ],
            [
                'sku' => 'SKU-0005',
                'name' => 'Product 5',
                'price' => '420.00'
            ],
            [
                'sku' => 'SKU-0006',
                'name' => 'Product 6',
                'price' => '690.00'
            ]
        ];

        Product::insert($products);
    }
}
