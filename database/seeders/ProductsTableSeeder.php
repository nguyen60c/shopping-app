<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'name' => 'MacBook Pro',
            'slug' => 'macbook-pro',
            'details' => '15 inch, 1TB HDD, 32GB RAM',
            'price' => 2499.99,
            'description' => 'MackBook Pro',
            'image_path' => 'macbook-pro.png'
        ]);

        Product::create([
            'name' => 'Dell Vostro 3557',
            'slug' => 'vostro-3557',
            'details' => '15 inch, 1TB HDD, 8GB RAM',
            'price' => 1499.99,
            'description' => 'Dell Vostro 3557',
            'image_path' => 'dell-v3557.png'
        ]);

        Product::create([
            'name' => 'iPhone 11 Pro',
            'slug' => 'iphone-11-pro',
            'details' => '6.1 inch, 64GB 4GB RAM',
            'price' => 649.99,
            'description' => 'iPhone 11 Pro',
            'image_path' => 'iphone-11-pro.png'
        ]);

        Product::create([
            'name' => 'Remax 610D Headset',
            'slug' => 'remax-610d',
            'details' => '6.1 inch, 64GB 4GB RAM',
            'price' => 8.99,
            'description' => 'Remax 610D Headset',
            'image_path' => 'remax-610d.jpg'
        ]);

        Product::create([
            'name' => 'Samsung LED TV',
            'slug' => 'samsung-led-24',
            'details' => '24 inch, LED Display, Resolution 1366 x 768',
            'price' => 41.99,
            'description' => 'Samsung LED TV',
            'image_path' => 'samsung-led-24.png'
        ]);

        Product::create([
            'name' => 'Samsung Digital Camera',
            'slug' => 'samsung-mv800',
            'details' => '16.1MP, 5x Optical Zoom',
            'price' => 144.99,
            'description' => 'Samsung Digital Camera',
            'image_path' => 'samsung-mv800.jpg'
        ]);

        Product::create([
            'name' => 'Huawei GR 5 2017',
            'slug' => 'gr5-2017',
            'details' => '5.5 inch, 32GB 4GB RAM',
            'price' => 148.99,
            'description' => 'Huawei GR 5 2017',
            'image_path' => 'gr5-2017.jpg'
        ]);
    }
}
