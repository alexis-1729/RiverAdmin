<?php

namespace App\Models;

use CodeIgniter\Model;

class RiosModel extends Model
{
  

    protected $table      = 'pmonitoreo';
    protected $primaryKey = 'monitoreo_id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['monitoreo_nombre', 'activo_m', 'riverubi_id', 'est_id'];

     protected $useTimestamps = false;
     protected $createdField = 'fecha_alta';
     protected $updatedField = 'fecha_edit';

    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;

}