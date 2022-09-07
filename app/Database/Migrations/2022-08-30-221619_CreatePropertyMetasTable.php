<?php

namespace App\Database\Migrations;

use App\Models\PropertyMetaModel;
use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class CreatePropertyMetasTable extends Migration
{
    public function up()
    {
        $fields = [
            'id',
            'property_id' => ['type' => 'INT', 'constraint' => 9,],
            'group_id'    => ['type' => 'INT', 'constraint' => 9,],
            'meta_key'    => ['type' => 'VARCHAR', 'constraint' => 100],
            'meta_title'  => ['type' => 'VARCHAR', 'constraint' => 100],
            'meta_value'  => ['type' => 'text'],
            'created_at'  => ['type' => 'TIMESTAMP', 'default' => new RawSql('CURRENT_TIMESTAMP'),],
        ];
        $this->forge->addField($fields);
        $this->forge->addForeignKey('group_id', 'property_meta_groups', 'id');
//        $this->forge->addForeignKey('property_id', 'properties', 'id');
        $this->forge->createTable('property_metas');
    }

    public function down()
    {
        $this->forge->dropTable('property_metas');
    }
}
