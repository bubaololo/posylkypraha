<?php

namespace Database\Seeders;

use App\Models\Enclosure;
use App\Models\ProductImage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

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
                'name' => 'Шляпки красного мухомора',
                'price' => 1000,
                'weight' => 20,
                'description' => 'Целые шляпки в вакуумной упаковке, собраны в экологически чистых лесах западной сибири, высушены при комнатной температуре',
            ],
            [
                'name' => 'Шляпки красного мухомора',
                'price' => 1300,
                'weight' => 30,
                'description' => 'Целые шляпки в вакуумной упаковке, собраны в экологически чистых лесах западной сибири, высушены при комнатной температуре',
            ],
            [
                'name' => 'Шляпки красного мухомора',
                'price' => 2000,
                'weight' => 50,
                'description' => 'Целые шляпки в вакуумной упаковке, собраны в экологически чистых лесах западной сибири, высушены при комнатной температуре',
            ],
            [
                'name' => 'Шляпки красного мухомора',
                'price' => 3500,
                'weight' => 100,
                'description' => 'Целые шляпки в вакуумной упаковке, собраны в экологически чистых лесах западной сибири, высушены при комнатной температуре',
            ],
        ];
        
        foreach ($products as &$product) {
            $product['slug'] = Str::slug($product['name'].$product['weight'].'gramm'.$product['price'].'rub');
        }
        Enclosure::insert($products);
        $images = [
            [
                'product_id' => 1,
                'primary' => true,
                'alt' => 'Целые шляпки в вакуумной упаковке, собраны в экологически чистых лесах западной сибири, высушены при комнатной температуре',
                'file' => '20.jpg',
            ],
            [
                'product_id' => 2,
                'primary' => true,
                'alt' => 'Целые шляпки в вакуумной упаковке, собраны в экологически чистых лесах западной сибири, высушены при комнатной температуре',
                'file' => '30.jpg',
            ],
            [
                'product_id' => 3,
                'primary' => true,
                'alt' => 'Целые шляпки в вакуумной упаковке, собраны в экологически чистых лесах западной сибири, высушены при комнатной температуре',
                'file' => '50.jpg',
            ],
            [
                'product_id' => 4,
                'primary' => true,
                'alt' => 'Целые шляпки в вакуумной упаковке, собраны в экологически чистых лесах западной сибири, высушены при комнатной температуре',
                'file' => '100.jpg',
            ],
        ];
        ProductImage::insert($images);
    }
}
