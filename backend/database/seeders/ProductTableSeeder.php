<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Date format constant.
     */
    private const DATE_FORMAT = 'Y-m-d H:i:s';

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $currentDateTime = date(self::DATE_FORMAT, time());

        $products = [
            [
                'name' => 'Labbaik Chicken Double B',
                'description' => 'Chicken burger + french fries + milky biscoff',
                'price' => 42000,
                'stock' => 40,
                'brand' => 'Labbaik Chicken',
                'image_url' => 'https://i.gojekapi.com/darkroom/gofood-indonesia/v2/images/uploads/488bd3a6-2c91-4a81-a99f-85abb8b0d15d_menu-item-image_1722564840237.jpg?auto=format',
                'created_at' => $currentDateTime,
                'updated_at' => $currentDateTime,
            ],
            [
                'name' => 'Waroeng Steak And Shake Super Box',
                'description' => '3 pcs chicken steak, 2 pcs tenderloin steak',
                'price' => 172000,
                'stock' => 52,
                'brand' => 'Waroeng Steak And Shake',
                'image_url' => 'https://i.gojekapi.com/darkroom/gofood-indonesia/v2/images/uploads/56c03671-1e19-44cd-86f0-fb896e42d192_menu-item-image_1676963206253.jpg?auto=format',
                'created_at' => $currentDateTime,
                'updated_at' => $currentDateTime,
            ],
            [
                'name' => 'HokBen Fried Chicken 1 pc + Hoka Hemat',
                'description' => '1 porsi paket HokBen fried chicken 1 pc + 1 porsi hoka',
                'price' => 71000,
                'stock' => 34,
                'brand' => 'HokBen',
                'image_url' => 'https://i.gojekapi.com/darkroom/gofood-indonesia/v2/images/uploads/cdd99d40-4c70-48fc-b43f-dd2a8b106bbc_menu-item-image_1722443431917.jpg?auto=format',
                'created_at' => $currentDateTime,
                'updated_at' => $currentDateTime,
            ],
            [
                'name' => 'HokBen Fried Chicken 1 pc + Hoka Hemat',
                'description' => '1 porsi paket HokBen fried chicken 1 pc + 1 porsi hoka',
                'price' => 71000,
                'stock' => 27,
                'brand' => 'HokBen',
                'image_url' => 'https://i.gojekapi.com/darkroom/gofood-indonesia/v2/images/uploads/cdd99d40-4c70-48fc-b43f-dd2a8b106bbc_menu-item-image_1722443431917.jpg?auto=format',
                'created_at' => $currentDateTime,
                'updated_at' => $currentDateTime,
            ],
            [
                'name' => 'Warung Suroboyo Bebek Goreng Krengseng Tanpa Nasi',
                'description' => 'Bebek goreng yang dilumuri dengan bumbu krengseng',
                'price' => 43750,
                'stock' => 64,
                'brand' => 'Warung Suroboyo',
                'image_url' => 'https://i.gojekapi.com/darkroom/gofood-indonesia/v2/images/uploads/390f8aae-632d-4e04-bffd-b4e9a5bd0097_master-menu-item-image_1599458950940.jpg?auto=format',
                'created_at' => $currentDateTime,
                'updated_at' => $currentDateTime,
            ],
            [
                'name' => 'Pizza Hut Buy 1 Get 1 Melts Pizza',
                'description' => 'Beli 1 Gratis 1 Pilih Topping Melts Pizza Favourite kamu',
                'price' => 60000,
                'stock' => 25,
                'brand' => 'Pizza Hut',
                'image_url' => 'https://i.gojekapi.com/darkroom/gofood-indonesia/v2/images/uploads/cbc04ff2-b82b-40fc-ac09-934576dd02d1_bogo-melts-phr-phd500x500-1724312743026.jpg?auto=format',
                'created_at' => $currentDateTime,
                'updated_at' => $currentDateTime,
            ],
            [
                'name' => 'Gokana Ramen & Teppan Rame 2',
                'description' => 'Beef original bento + gokana 1 + chicken original bento',
                'price' => 135000,
                'stock' => 51,
                'brand' => 'Gokana Ramen & Teppan',
                'image_url' => 'https://i.gojekapi.com/darkroom/gofood-indonesia/v2/images/uploads/452f4663-c3fa-43bd-9c25-bd67a48b3a76_menu-item-image_1722479332711.jpg?auto=format',
                'created_at' => $currentDateTime,
                'updated_at' => $currentDateTime,
            ],
        ];

        Product::insert($products);
    }
}
