<?php

namespace App\Database\Seeds;

use App\Models\PropertyGalleryModel;
use CodeIgniter\Database\Seeder;
use Faker\Factory;

class PropertyGalleriesSeeder extends Seeder
{
    public function run()
    {
        $faker = Factory::create();
        $files = [];
//        $image = $faker->imageUrl();
        for ($j = 0; $j <= 5; $j++) {
            for ($i = 1; $i <= 12; $i++) {
                $img_name = mt_rand(1, 12);
                $files[]  = [
                    'file_path'   => realpath('uploads/properties/'.$img_name.'.jpg'),
                    'file_url'    => base_url('uploads/properties/'.$img_name.'.jpg'),
                    'property_id' => $i,
                ];
            }
        }

        return model(PropertyGalleryModel::class)->insertBatch($files);
//        $this->db->table('property_galleries')->insertBatch($files);
    }
}
