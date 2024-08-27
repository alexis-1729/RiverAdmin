<?php

namespace App\Models;

use CodeIgniter\Model;

class DispositivosModel extends Model
{
  

    protected $table      = 'dispositivo';
    protected $primaryKey = 'circuito_id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['pmonitoreo_id','pos_id','circuito_nombre', 'activo', 'estado_id', 'sensor_id'];

     protected $useTimestamps = false;
     protected $createdField = 'fecha_alta';
     protected $updatedField = 'fecha_edit';

    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;

}