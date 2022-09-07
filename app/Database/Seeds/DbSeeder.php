<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DbSeeder extends Seeder
{
    public function run()
    {
        $this->call('PropertyTypesSeeder');
        $this->call('PropertiesSeeder');
        $this->call('PropertyGalleriesSeeder');
//        $this->call('PropertyGalleriesSeeder');
//        $this->call('PropertyGalleriesSeeder');
        $this->call('PropertyMetaGroupsSeeder');
        $this->call('PropertyMetasSeeder');
        $this->call('UsersSeeder');
    }
}
