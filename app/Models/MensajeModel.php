<?php

namespace App\Models;

use CodeIgniter\Model;

class MensajeModel extends Model
{
  

    protected $table      = 'foro';
    protected $primaryKey = 'id_mensaje';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['mensaje', 'user_id', 'user_admin', 'revisado','titulo'];

     protected $useTimestamps = false;
     protected $createdField = 'fecha_creacion';
     protected $updatedField = 'fecha_actualizacion';

    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;

}