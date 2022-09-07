<?php

namespace App\Database\Seeds;

use App\Models\PropertyTypeModel;
use CodeIgniter\Database\Seeder;
use Faker\Factory;

class PropertyTypesSeeder extends Seeder
{
    public function run()
    {
        $faker      = Factory::create();
        $type_names = ['خانه', 'ویلا', 'آپارتمان', 'باغچه'];
        $types      = [];
        foreach ($type_names as $type) {
            $types[] = [
                'name'        => $type,
                'description' => $faker->realTextBetween(100, 150),
            ];
        }

        return model(PropertyTypeModel::class)->insertBatch($types);
    }
}
