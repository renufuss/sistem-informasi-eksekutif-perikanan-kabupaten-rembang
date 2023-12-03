<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Productions extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'production_id' => [
                'type'           => 'BIGINT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'total_production_amount' => [
                'type'           => 'DOUBLE',
                'comment'     => 'Ton',
            ],
            'total_production_value' => [
                'type'           => 'BIGINT',
                'comment'     => 'Rupiah',
            ],
            'year_id' => [
                'unsigned'     => true,
                'type'       => 'BIGINT',
            ],
        ]);
        $this->forge->addKey('production_id', true);

        $this->forge->addForeignKey('year_id', 'years', 'year_id');
        $this->forge->createTable('productions');
    }

    public function down()
    {
        $this->forge->dropTable('productions');
    }
}
