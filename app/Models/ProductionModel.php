<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductionModel extends Model
{
    protected $table      = 'productions';
    protected $primaryKey = 'production_id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'object';

    public function getProduction()
    {
        $query = $this->db->table($this->table)->select('*')
        ->join('years', 'productions.year_id = years.year_id', 'inner');
        return $query->get()->getResultObject();
    }

    public function getProductionByYear($year)
    {
        $query = $this->db->table($this->table)->select('*')->where('year', $year)
        ->join('years', 'productions.year_id = years.year_id', 'inner');
        return $query->get()->getFirstRow();
    }
}
