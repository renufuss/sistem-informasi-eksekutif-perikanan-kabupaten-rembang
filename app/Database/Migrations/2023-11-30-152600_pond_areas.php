<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PondAreas extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'pond_id' => [
                'type'           => 'BIGINT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'pond_wide' => [
                'type'           => 'DOUBLE',
                'comment'     => 'Ha',
            ],
            'year_id' => [
                'unsigned'     => true,
                'type'       => 'BIGINT',
            ],
        ]);
        $this->forge->addKey('pond_id', true);

        $this->forge->addForeignKey('year_id', 'years', 'year_id');
        $this->forge->createTable('pond_areas');
    }

    public function down()
    {
        $this->forge->dropTable('pond_areas');
    }
}
