<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductionDetailModel extends Model
{
    protected $table      = 'production_details';
    protected $primaryKey = 'production_detail_id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'object';

    public function getProductionDetail($productionId)
    {
        $query = $this->db->table($this->table)->select('*')->where('production_id', $productionId)
        ->join('production_types', 'production_details.production_type_id = production_types.production_type_id', 'inner');
        return $query->get()->getResultObject();
    }

    public function getProductionValue($productionId)
    {
        $query = $this->db->table($this->table)->select('*')->where('production_id', $productionId)
        ->join('production_types', 'production_details.production_type_id = production_types.production_type_id', 'inner');
        return $query->get()->getResultObject();
    }
}
