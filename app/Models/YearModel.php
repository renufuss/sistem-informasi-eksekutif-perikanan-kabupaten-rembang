<?php

namespace App\Models;

use CodeIgniter\Model;

class YearModel extends Model
{
    protected $table      = 'years';
    protected $primaryKey = 'year_id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'object';

}
