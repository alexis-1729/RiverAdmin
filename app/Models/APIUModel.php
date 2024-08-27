<?php
namespace App\Models;

use CodeIgniter\Model;

class APIUModel extends Model {
    protected $table      = 'info_user';
    protected $primaryKey = 'user_id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['user_nombre','user_apellido','user_email','user_usuario',	'user_password','est_id','cuenta_id','user_cel','activo','user_rioid','fcm_token'];

     protected $useTimestamps = false;
     protected $createdField = 'fecha_alta';
     protected $updatedField = 'fecha_edit';

    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
}


?>
