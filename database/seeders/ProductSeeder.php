<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::create([
            'name' => 'Teclado mecánico',
            'description' => 'Teclado mecánico retroiluminado RGB',
            'price' => 45999.99,
            'stock' => 15,
        ]);

        Product::create([
            'name' => 'Mouse inalámbrico',
            'description' => 'Mouse ergonómico con batería recargable',
            'price' => 18500.00,
            'stock' => 30,
        ]);

        Product::create([
            'name' => 'Monitor 24 pulgadas',
            'description' => 'Monitor Full HD IPS 75Hz',
            'price' => 129999.00,
            'stock' => 8,
        ]);

        Product::create([
            'name' => 'Auriculares Bluetooth',
            'description' => 'Auriculares con cancelación de ruido',
            'price' => 32000.50,
            'stock' => 20,
        ]);
    }
}