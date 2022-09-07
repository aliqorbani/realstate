<?php

namespace App\Database\Seeds;

use App\Models\PropertyModel;
use CodeIgniter\Database\Seeder;
use Faker\Factory;

class PropertiesSeeder extends Seeder
{
    public function run()
    {
        $properties     = [];
        $faker          = Factory::create('fa_IR');
        $building_names = ['آفتاب', 'گلبرگ', 'غنچه', 'ونوس', 'فرهنگ', 'زنبق', 'کورش', 'آزادی', 'ستاره', 'بزرگ'];
        for ($i = 1; $i <= 12; $i++) {
            $price        = $faker->randomNumber(9);
            $properties[] = [
                'name'        => $faker->randomElement($building_names),
                'type_id'     => mt_rand(1, 4),
                'description' => $faker->text,
                'address'     => $faker->address,
                'latitude'    => $faker->latitude(34, 36),
                'longitude'   => $faker->longitude(50, 52),
                'status'      => $faker->randomElement(['publish', 'pending', 'sold']),
                'price'       => $price,
                'final_price' => $price,
            ];
        }

        return model(PropertyModel::class)->insertBatch($properties);
    }
}
