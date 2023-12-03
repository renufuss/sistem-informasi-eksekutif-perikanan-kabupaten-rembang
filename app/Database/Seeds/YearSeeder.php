<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class YearSeeder extends Seeder
{
    public function run()
    {
        $firstYear = 2016;
        $lastYear = 2022;
        $years = [];
        for ($i = $firstYear; $i <= $lastYear; $i++) {
            array_push($years, ['year' => $i]);
        }

        $this->db->table('years')->insertBatch($years);
    }
}
