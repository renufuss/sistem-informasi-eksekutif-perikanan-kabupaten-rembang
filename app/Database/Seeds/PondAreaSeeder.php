<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PondAreaSeeder extends Seeder
{
    public function run()
    {
        $rawPondAreas = [
            [
                'pond_wide' => 2396.30,
                'year'    => 2017,
            ],
            [
                'pond_wide' => 2396.3,
                'year'    => 2018,
            ],
            [
                'pond_wide' => 2396.30,
                'year'    => 2019,
            ],
            [
                'pond_wide' => 2396.30,
                'year'    => 2020,
            ],
            [
                'pond_wide' => 2396.30,
                'year'    => 2021,
            ],
            [
                'pond_wide' => 2396.30,
                'year'    => 2022,
            ],
        ];

        $pondAreas = [];
        foreach ($rawPondAreas as $rawPondArea) {
            $yearId = $this->findYearId($rawPondArea['year']);
            array_push($pondAreas, [
                'pond_wide' => $rawPondArea['pond_wide'],
                'year_id' => $yearId,
            ]);
        }



        $this->db->table('pond_areas')->insertBatch($pondAreas);
    }

    private function findYearId($year)
    {
        $query = $this->db->table('years')->where('year', $year);
        $result = $query->get()->getFirstRow();
        return $result->year_id;
    }
}
