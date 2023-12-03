<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProductionDetailSeeder extends Seeder
{
    public function run()
    {
        $rawProductionDetails = [
            [
                'production_amount' => 1334.26,
                'production_value' => 22668790000,
                'production_type' => 'Udang Windu',
                'year'    => 2016,
            ],
            [
                'production_amount' => 3542.51,
                'production_value' => 283400436000,
                'production_type' => 'Udang Vanamei',
                'year'    => 2016,
            ],
            [
                'production_amount' => 474.94,
                'production_value' => 37995353000,
                'production_type' => 'Bandeng',
                'year'    => 2016,
            ],
            [
                'production_amount' => 158.21,
                'production_value' => 2214904000,
                'production_type' => 'Lain-lain',
                'year'    => 2016,
            ],
            [
                'production_amount' => 1518.83,
                'production_value' => 22756744000,
                'production_type' => 'Udang Windu',
                'year'    => 2017,
            ],
            [
                'production_amount' => 2956.31,
                'production_value' => 236504638000,
                'production_type' => 'Udang Vanamei',
                'year'    => 2017,
            ],
            [
                'production_amount' => 467.29,
                'production_value' => 37383558000,
                'production_type' => 'Bandeng',
                'year'    => 2017,
            ],
            [
                'production_amount' => 132.02,
                'production_value' => 1848200000,
                'production_type' => 'Lain-lain',
                'year'    => 2017,
            ],
            [
                'production_amount' => 463.98,
                'production_value' => 27564156000,
                'production_type' => 'Udang Windu',
                'year'    => 2018,
            ],
            [
                'production_amount' => 2956.31,
                'production_value' => 236504638000,
                'production_type' => 'Udang Vanamei',
                'year'    => 2018,
            ],
            [
                'production_amount' => 1347.91,
                'production_value' => 22858049000,
                'production_type' => 'Bandeng',
                'year'    => 2018,
            ],
            [
                'production_amount' => 58.38,
                'production_value' => 817320000,
                'production_type' => 'Lain-lain',
                'year'    => 2018,
            ],
            [
                'production_amount' => 539.48,
                'production_value' => 43158599000,
                'production_type' => 'Udang Windu',
                'year'    => 2019,
            ],
            [
                'production_amount' => 3092.49,
                'production_value' => 247398878000,
                'production_type' => 'Udang Vanamei',
                'year'    => 2019,
            ],
            [
                'production_amount' => 1450.28,
                'production_value' => 28890646000,
                'production_type' => 'Bandeng',
                'year'    => 2019,
            ],
            [
                'production_amount' => 44.69,
                'production_value' => 625716000,
                'production_type' => 'Lain-lain',
                'year'    => 2019,
            ],
            [
                'production_amount' => 554.37,
                'production_value' => 44349606780,
                'production_type' => 'Udang Windu',
                'year'    => 2020,
            ],
            [
                'production_amount' => 3191.45,
                'production_value' => 255315644160,
                'production_type' => 'Udang Vanamei',
                'year'    => 2020,
            ],
            [
                'production_amount' => 1494.69,
                'production_value' => 29893718640,
                'production_type' => 'Bandeng',
                'year'    => 2020,
            ],
            [
                'production_amount' => 45.71,
                'production_value' => 731336861,
                'production_type' => 'Lain-lain',
                'year'    => 2020,
            ],
            [
                'production_amount' => 571.56,
                'production_value' => 45724960000,
                'production_type' => 'Udang Windu',
                'year'    => 2021,
            ],
            [
                'production_amount' => 3235.94,
                'production_value' => 258875120000,
                'production_type' => 'Udang Vanamei',
                'year'    => 2021,
            ],
            [
                'production_amount' => 1521.28,
                'production_value' => 30425500000,
                'production_type' => 'Bandeng',
                'year'    => 2021,
            ],
            [
                'production_amount' => 132.05,
                'production_value' => 2112832000,
                'production_type' => 'Lain-lain',
                'year'    => 2021,
            ],
            [
                'production_amount' => 555.70,
                'production_value' => 44456160000,
                'production_type' => 'Udang Windu',
                'year'    => 2022,
            ],
            [
                'production_amount' => 3186.91,
                'production_value' => 254952720000,
                'production_type' => 'Udang Vanamei',
                'year'    => 2022,
            ],
            [
                'production_amount' => 1498.767,
                'production_value' => 32972874000,
                'production_type' => 'Bandeng',
                'year'    => 2022,
            ],
            [
                'production_amount' => 121.604,
                'production_value' => 1945664000,
                'production_type' => 'Lain-lain',
                'year'    => 2022,
            ],
        ];

        $productionDetails = [];
        foreach ($rawProductionDetails as $rawProductionDetail) {
            $yearId = $this->findYearId($rawProductionDetail['year']);
            $productionId = $this->findProductionIdByYear($yearId);
            $productionTypeId = $this->findProductionTypeId($rawProductionDetail['production_type']);
            array_push($productionDetails, [
                'production_amount' => $rawProductionDetail['production_amount'],
                'production_value' => $rawProductionDetail['production_value'],
                'production_id' => $productionId,
                'production_type_id' => $productionTypeId,
            ]);
        }



        $this->db->table('production_details')->insertBatch($productionDetails);
    }

    private function findYearId($year)
    {
        $query = $this->db->table('years')->where('year', $year);
        $result = $query->get()->getFirstRow();
        return $result->year_id;
    }

    private function findProductionTypeId($productionType)
    {
        $query = $this->db->table('production_types')->where('production_type_name', $productionType);
        $result = $query->get()->getFirstRow();
        return $result->production_type_id;
    }

    private function findProductionIdByYear($yearId)
    {
        $query = $this->db->table('productions')->where('year_id', $yearId);
        $result = $query->get()->getFirstRow();
        return $result->production_id;
    }
}
