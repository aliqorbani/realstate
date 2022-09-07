<?php

namespace App\Database\Seeds;

use App\Models\PropertyMetaGroupModel;
use CodeIgniter\Database\Seeder;

class PropertyMetaGroupsSeeder extends Seeder
{
    public function run()
    {
        $meta_groups = [
            [
                'group_title' => 'امکانات ساختمان',
                'group_value' => 'building_facilities',
            ],
            [
                'group_title' => 'امکانات اتاق',
                'group_value' => 'room_facilities',
            ],
            [
                'group_title' => 'دسترسی به امکانات شهری',
                'group_value' => 'city_facilities'
            ]
        ];

        return model(PropertyMetaGroupModel::class)->insertBatch($meta_groups);
//        $this->db->table('property_meta_groups')->insertBatch($meta_groups);
    }
}
