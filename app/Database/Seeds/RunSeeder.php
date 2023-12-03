<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RunSeeder extends Seeder
{
    public function run()
    {
        $this->call('YearSeeder');
        $this->call('CultivatorSeeder');
        $this->call('PondAreaSeeder');
        $this->call('ProductionTypeSeeder');
        $this->call('ProductionSeeder');
        $this->call('ProductionDetailSeeder');
    }
}
