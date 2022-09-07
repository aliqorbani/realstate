<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class CreatePropertyMetaGroupsTable extends Migration
{
    public function up()
    {
        $fields = [
            'id',
            'group_title' => ['type' => 'VARCHAR', 'constraint' => 100],
            'group_value' => ['type' => 'text'],
            'created_at'  => ['type' => 'TIMESTAMP', 'default' => new RawSql('CURRENT_TIMESTAMP'),],
        ];
        $this->forge->addField($fields);
        $this->forge->createTable('property_meta_groups');
    }

    public function down()
    {
        $this->forge->dropTable('property_meta_groups');
    }
}
