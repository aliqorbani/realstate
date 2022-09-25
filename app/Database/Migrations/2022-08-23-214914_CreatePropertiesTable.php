<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class CreatePropertiesTable extends Migration
{
    public function up()
    {
        $fields = [
            'id',
            'name'        => ['type' => 'VARCHAR', 'constraint' => 100],
            'type_id'     => ['type' => 'INT', 'constraint' => 9,],
            'description' => ['type' => 'text', 'null' => true,],
            'address'     => ['type' => 'text', 'null' => true,],
            'latitude'    => ['type' => 'decimal', 'constraint' => '16,14', 'null' => true,],
            'longitude'   => ['type' => 'decimal', 'constraint' => '16,14', 'null' => true,],
            'zoom'        => ['type' => 'INT', 'constraint' => 3, 'null' => true],
            'status'      => ['type' => 'enum', 'constraint' => ['publish', 'pending', 'sold'], 'default' => 'pending'],
            'price'       => ['type' => 'INT', 'constraint' => 14, 'null' => true],
            'final_price' => ['type' => 'INT', 'constraint' => 14, 'null' => true],
            'created_at'  => ['type' => 'TIMESTAMP', 'default' => new RawSql('CURRENT_TIMESTAMP'),],
            'updated_at'  => ['type' => 'TIMESTAMP', 'default' => null, 'onUpdate' => new RawSql('CURRENT_TIMESTAMP'),],
        ];

        $this->forge->addField($fields);
        $this->forge->addForeignKey('type_id', 'property_types', 'id');
        $this->forge->createTable('properties', true);


    }

    public function down()
    {
        $this->forge->dropTable('properties', true);
    }
}
