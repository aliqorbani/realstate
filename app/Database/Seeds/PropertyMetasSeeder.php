<?php

namespace App\Database\Seeds;

use App\Models\PropertyMetaModel;
use App\Models\PropertyModel;
use CodeIgniter\Database\Seeder;
use Faker\Factory;

class PropertyMetasSeeder extends Seeder
{

    public function run()
    {
        $faker      = Factory::create();
        $metas      = [];
        $model      = model(PropertyModel::class);
        $properties = $model->builder()->get()->getResultArray();
        foreach ($properties as $property) {
            $metas[] = [
                'meta_key'    => 'rooms_count',
                'meta_title'  => 'تعداد اتاق',
                'group_id'    => '1',
                'meta_value'  => mt_rand(1, 5),
                'property_id' => $property['id'],
            ];
            $metas[] = [
                'meta_key'    => 'building_area',
                'meta_title'  => 'متراژ',
                'group_id'    => '1',
                'meta_value'  => mt_rand(50, 300),
                'property_id' => $property['id'],
            ];
            $metas[] = [
                'meta_key'    => 'building_year',
                'meta_title'  => 'سال ساخت/بازسازی',
                'group_id'    => '1',
                'meta_value'  => $faker->dateTimeBetween('-10 years')->format('Y'),
                'property_id' => $property['id'],
            ];
        }

        log_message(3, 'meta_values => '.json_encode($metas, 256 | 64));

        return model(PropertyMetaModel::class)->insertBatch($metas);
    }
}
