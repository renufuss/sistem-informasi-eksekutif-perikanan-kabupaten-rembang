<?php

namespace App\Models;

use CodeIgniter\Model;

class PondAreaModel extends Model
{
    protected $table      = 'pond_areas';
    protected $primaryKey = 'pond_id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'object';

    public function getPondAreaByYear($year)
    {
        $query = $this->db->table($this->table)->select('*')->where('year', $year)
        ->join('years', 'pond_areas.year_id = years.year_id', 'inner');
        return $query->get()->getFirstRow();
    }

}
