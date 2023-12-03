<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ProductionTypes extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'production_type_id' => [
                'type'           => 'BIGINT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'production_type_name' => [
                'type'           => 'Varchar',
                'constraint'     => '255',
            ],
        ]);
        $this->forge->addKey('production_type_id', true);

        $this->forge->createTable('production_types');
    }

    public function down()
    {
        $this->forge->dropTable('production_types');
    }
}
