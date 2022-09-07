<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class CreatePropertyGalleriesTable extends Migration
{
    public function up()
    {
        $fields = [
            'id',
            'property_id' => ['type' => 'INT', 'constraint' => 9,],
            'file_path'   => ['type' => 'text', 'null' => false],
            'file_url'    => ['type' => 'text', 'null' => false],
            'created_at'  => ['type' => 'TIMESTAMP', 'default' => new RawSql('CURRENT_TIMESTAMP'),],
            'updated_at'  => ['type' => 'TIMESTAMP', 'default' => new RawSql('CURRENT_TIMESTAMP'),],
        ];
        $this->forge->addField($fields);
        $this->forge->addForeignKey('property_id', 'properties', 'id');
        $this->forge->createTable('property_galleries', true);
    }

    public function down()
    {
        $this->forge->dropTable('property_galleries');
    }
}
