<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; 

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        DB::table('products')->insert([
            ['name' => 'Product 1', 'product_id' => '1001', 'available_stocks' => 100, 'price_per_unit' => 10.00, 'tax_percentage' => 5.00],
            ['name' => 'Product 2', 'product_id' => '1002', 'available_stocks' => 50, 'price_per_unit' => 20.00, 'tax_percentage' => 10.00],
            ['name' => 'Product 3', 'product_id' => '1003', 'available_stocks' => 75, 'price_per_unit' => 15.00, 'tax_percentage' => 8.00],
            ['name' => 'Product 4', 'product_id' => '1004', 'available_stocks' => 200, 'price_per_unit' => 5.00, 'tax_percentage' => 5.00],
            ['name' => 'Product 5', 'product_id' => '1005', 'available_stocks' => 30, 'price_per_unit' => 25.00, 'tax_percentage' => 12.00],
            ['name' => 'Product 6', 'product_id' => '1006', 'available_stocks' => 60, 'price_per_unit' => 30.00, 'tax_percentage' => 15.00],
            ['name' => 'Product 7', 'product_id' => '1007', 'available_stocks' => 80, 'price_per_unit' => 12.50, 'tax_percentage' => 7.00],
            ['name' => 'Product 8', 'product_id' => '1008', 'available_stocks' => 90, 'price_per_unit' => 18.00, 'tax_percentage' => 9.00],
            ['name' => 'Product 9', 'product_id' => '1009', 'available_stocks' => 40, 'price_per_unit' => 22.00, 'tax_percentage' => 11.00],
            ['name' => 'Product 10', 'product_id' => '1010', 'available_stocks' => 110, 'price_per_unit' => 8.00, 'tax_percentage' => 6.00],
            ['name' => 'Product 11', 'product_id' => '1011', 'available_stocks' => 120, 'price_per_unit' => 14.00, 'tax_percentage' => 4.00],
            ['name' => 'Product 12', 'product_id' => '1012', 'available_stocks' => 70, 'price_per_unit' => 16.00, 'tax_percentage' => 10.00],
            ['name' => 'Product 13', 'product_id' => '1013', 'available_stocks' => 55, 'price_per_unit' => 19.00, 'tax_percentage' => 8.00],
            ['name' => 'Product 14', 'product_id' => '1014', 'available_stocks' => 45, 'price_per_unit' => 21.00, 'tax_percentage' => 9.00],
            ['name' => 'Product 15', 'product_id' => '1015', 'available_stocks' => 95, 'price_per_unit' => 11.00, 'tax_percentage' => 5.00],
            ['name' => 'Product 16', 'product_id' => '1016', 'available_stocks' => 65, 'price_per_unit' => 17.00, 'tax_percentage' => 6.00],
            ['name' => 'Product 17', 'product_id' => '1017', 'available_stocks' => 85, 'price_per_unit' => 13.00, 'tax_percentage' => 7.00],
            ['name' => 'Product 18', 'product_id' => '1018', 'available_stocks' => 35, 'price_per_unit' => 23.00, 'tax_percentage' => 12.00],
            ['name' => 'Product 19', 'product_id' => '1019', 'available_stocks' => 25, 'price_per_unit' => 27.00, 'tax_percentage' => 15.00],
        ]);


    }
}
