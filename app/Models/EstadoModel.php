<?php

namespace App\Models;

use CodeIgniter\Model;

class EstadoModel extends Model
{
  

    protected $table      = 'estado';
    protected $primaryKey = 'estado_id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['estado_nombre', 'active'];

     protected $useTimestamps = false;
     protected $createdField = 'fecha_alta';
     protected $updatedField = 'fecha_edit';

    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;

}