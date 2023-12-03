<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProductionSeeder extends Seeder
{
    public function run()
    {
        $rawProductions = [
            [
            'total_production_amount' => 5509.92,
            'total_production_value' => 346279483000,
            'year'    => 2016,
            ],
            [
            'total_production_amount' => 5074.45,
            'total_production_value' => 298493140000,
            'year'    => 2017,
            ],
            [
            'total_production_amount' => 4826.58,
            'total_production_value' => 287744163000,
            'year'    => 2018,
            ],
            [
            'total_production_amount' =>  5126.94,
            'total_production_value' => 320073839000,
            'year'    => 2019,
            ],
            [
            'total_production_amount' =>  5286.21,
            'total_production_value' => 330290306441,
            'year'    => 2020,
            ],
            [
            'total_production_amount' => 5460.83,
            'total_production_value' =>  337138412000,
            'year'    => 2021,
            ],
            [
            'total_production_amount' => 5362.98,
            'total_production_value' =>  334327418000,
            'year'    => 2022,
            ],
        ];

        $productions = [];
        foreach ($rawProductions as $rawProduction) {
            $yearId = $this->findYearId($rawProduction['year']);
            array_push($productions, [
                'total_production_amount' => $rawProduction['total_production_amount'],
                'total_production_value' => $rawProduction['total_production_value'],
                'year_id' => $yearId,
            ]);
        }



        $this->db->table('productions')->insertBatch($productions);
    }

    private function findYearId($year)
    {
        $query = $this->db->table('years')->where('year', $year);
        $result = $query->get()->getFirstRow();
        return $result->year_id;
    }
}
