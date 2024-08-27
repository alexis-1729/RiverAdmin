<?php
namespace App\Models;

use CodeIgniter\Model;

class UbiModel extends Model {
    protected $table      = 'river_ubi';
    protected $primaryKey = 'ubi_id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['ubi_latitud','ubi_longitud'];

     protected $useTimestamps = false;
     protected $createdField = 'sens_fecha';
     //agregar sens hora
     protected $updatedField = 'fecha_edit';

    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
}


?>
