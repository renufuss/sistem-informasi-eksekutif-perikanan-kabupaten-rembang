<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProductionTypeSeeder extends Seeder
{
    public function run()
    {
        $types = ['Udang Windu', 'Udang Vanamei', 'Bandeng', 'Lain-lain'];
        $productionTypes = [];
        foreach ($types as $type) {
            array_push($productionTypes, ['production_type_name' => $type]);
        }

        $this->db->table('production_types')->insertBatch($productionTypes);
    }
}
