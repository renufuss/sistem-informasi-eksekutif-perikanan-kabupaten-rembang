<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ProductionDetails extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'production_detail_id' => [
                'type'           => 'BIGINT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'production_amount' => [
                'type'           => 'DOUBLE',
                'comment'     => 'Ton',
            ],
            'production_value' => [
                'type'           => 'BIGINT',
                'comment'     => 'Rupiah',
            ],
            'production_type_id' => [
                'type'           => 'BIGINT',
                'unsigned'       => true,
            ],
            'production_id' => [
                'type'           => 'BIGINT',
                'unsigned'       => true,
            ],
        ]);
        $this->forge->addKey('production_detail_id', true);

        $this->forge->addForeignKey('production_id', 'productions', 'production_id');
        $this->forge->addForeignKey('production_type_id', 'production_types', 'production_type_id');
        $this->forge->createTable('production_details');
    }

    public function down()
    {
        $this->forge->dropTable('production_details');
    }
}
