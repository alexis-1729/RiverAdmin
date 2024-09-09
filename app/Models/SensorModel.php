<?php
namespace App\Models;

use CodeIgniter\Model;

class SensorModel extends Model {
    protected $table      = 'info_sensores';
    protected $primaryKey = 'sens_id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['sens_nivel','sens_temp','sens_vel','ard_id'];

     protected $useTimestamps = true;
     protected $createdField = 'sens_fecha';
     protected $updatedField = 'sens_hora';

    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
}
?>
