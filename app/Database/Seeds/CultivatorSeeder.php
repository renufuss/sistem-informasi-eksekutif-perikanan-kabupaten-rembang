<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CultivatorSeeder extends Seeder
{
    public function run()
    {
        $rawCultivators = [
            [
            'total_cultivator' => 897,
            'year'    => 2016,
            ],
            [
                'total_cultivator' => 897,
                'year'    => 2017,
            ],
            [
                'total_cultivator' => 897,
                'year'    => 2018,
            ],
            [
                'total_cultivator' => 1048,
                'year'    => 2019,
            ],
            [
                'total_cultivator' => 1048,
                'year'    => 2020,
            ],
            [
                'total_cultivator' => 1048,
                'year'    => 2021,
            ],
            [
                'total_cultivator' => 1048,
                'year'    => 2022,
            ],
        ];

        $cultivators = [];
        foreach ($rawCultivators as $rawCultivator) {
            $yearId = $this->findYearId($rawCultivator['year']);
            array_push($cultivators, [
                'total_cultivator' => $rawCultivator['total_cultivator'],
                'year_id' => $yearId,
            ]);
        }



        $this->db->table('cultivators')->insertBatch($cultivators);
    }

    private function findYearId($year)
    {
        $query = $this->db->table('years')->where('year', $year);
        $result = $query->get()->getFirstRow();
        return $result->year_id;
    }
}
