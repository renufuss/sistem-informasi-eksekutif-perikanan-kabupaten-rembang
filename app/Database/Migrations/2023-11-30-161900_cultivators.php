<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class cultivators extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'cultivator_id' => [
                'type'           => 'BIGINT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'total_cultivator' => [
                'type'           => 'BIGINT',
            ],
            'year_id' => [
                'unsigned'     => true,
                'type'       => 'BIGINT',
            ],
        ]);
        $this->forge->addKey('cultivator_id', true);

        $this->forge->addForeignKey('year_id', 'years', 'year_id');
        $this->forge->createTable('cultivators');
    }

    public function down()
    {
        $this->forge->dropTable('cultivators');
    }
}
