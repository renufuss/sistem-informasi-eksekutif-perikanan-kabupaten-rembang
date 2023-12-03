<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Years extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'year_id' => [
                'type'           => 'BIGINT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'year' => [
                'type'       => 'YEAR',
            ],
        ]);
        $this->forge->addKey('year_id', true);
        $this->forge->createTable('years');
    }

    public function down()
    {
        $this->forge->dropTable('years');
    }
}
