<?php
namespace App\Models;

use CodeIgniter\Model;

class UserposModel extends Model {
    protected $table      = 'user_pos';
    protected $primaryKey = 'userpos_id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['user_id','alerta','latitud','longitud'];

     protected $useTimestamps = true;
     protected $createdField = 'fecha_subida';
     protected $updatedField = 'fecha_actualizada';

    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
}


?>
