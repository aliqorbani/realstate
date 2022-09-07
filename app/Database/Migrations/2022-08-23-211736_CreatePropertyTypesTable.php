<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class CreatePropertyTypesTable extends Migration
{
    public function up()
    {
        $fields = [
            'id',
            'name'        => ['type' => 'VARCHAR', 'constraint' => 100],
            'description' => ['type' => 'text'],
            'created_at'  => ['type' => 'TIMESTAMP', 'default' => new RawSql('CURRENT_TIMESTAMP'),],
            'updated_at'  => ['type' => 'TIMESTAMP', 'default' => new RawSql('CURRENT_TIMESTAMP'),],
        ];
        $this->forge->addField($fields);
        $this->forge->createTable('property_types');
    }

    public function down()
    {
        $this->forge->dropTable('property_types');
    }
}
