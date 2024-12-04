<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\RegistroModel;


class Registro extends BaseController
{

    protected $users;
    protected $reglas;
    protected $reglasR;
    protected $reglasA;
    protected $sesion;
    public function __construct()
    {
        $this-> users = new RegistroModel();
        $this->sesion = session();
        helper(['form']);
        $this->reglas = [
            'user_nombre'=> [
                    'rules' => 'required|min_length[3]',
                    'errors' => [
                        'required' =>'El campo {field} es obligatorio',
                        'min_length' => 'El nombre debe tener minimo 3 caracteres'
                    ]
            ],
            'user_usuario'=> [
                    'rules' => 'required|min_length[3]',
                    'errors' => [
                        'required' =>'El campo {field} es obligatorio',
                        'min_length' => 'El usuario debe tener minimo 3 caracteres'
                    ]
            ],
            'user_apellido'=> [
                    'rules' => 'required|min_length[3]',
                    'errors' => [
                        'required' =>'El campo {field} es obligatorio',
                        'min_length' => 'El nombre debe tener minimo 3 caracteres'
                    ]
            ],
            'user_email'=> [
                    'rules' => 'required|valid_email|is_unique[info_user.user_email]',
                    'errors' => [
                        'required' =>'El campo {field} es obligatorio',
                        'valid_email' => 'El correo no es valido',
                        'is_unique' => 'El correo ya esta registrado'
                    ]
            ],
            'user_cel'=> [
                    'rules' => 'required|exact_length[10]|is_natural',
                    'errors' => [
                        'required' =>'El campo {field} es obligatorio',
                        'exact_length' => 'El numero debe contener 10 digitos.',
                        'is_natural' => 'EL numero debe contener solo digitos del 0-9.'
                    ]
            ],
            'user_password'=> [
                'rules' => 'required|min_length[8]|max_length[20]',
                'errors' => [
                    'required' =>'El campo {field} es obligatorio',
                    'min_length' => 'La contraseña debe tener al menos 8 caracteres',
                    'max_length[20]' => 'La contraseña debe tener maximo 20 caracteres'
                ]
                ],
              'repassword'=> [
                'rules' => 'required|matches[user_password]',
                'errors' => [
                    'required' =>'El campo {field} es obligatorio',
                    'matches' => 'Las contraseñas no coinciden.'
                ]
                ],
                'cuenta_id'=> [
                    'rules' => 'required',
                    'errors' => [
                        'required' =>'El campo {field} es obligatorio'
                    ]
                ],
                'est_id'=> [
                    'rules' => 'required',
                    'errors' => [
                        'required' =>'El campo {field} es obligatorio'
                    ]
                ],
                'user_rioid'=> [
                    'rules' => 'required',
                    'errors' => [
                        'required' =>'El campo {field} es obligatorio'
                    ]
                ]
        ];

        $this->reglasA = [
            'user_nombre'=> [
                    'rules' => 'required|min_length[3]',
                    'errors' => [
                        'required' =>'El campo {field} es obligatorio',
                        'min_length' => 'El nombre debe tener minimo 3 caracteres'
                    ]
            ],
            'user_usuario'=> [
                    'rules' => 'required|min_length[3]',
                    'errors' => [
                        'required' =>'El campo {field} es obligatorio',
                        'min_length' => 'El usuario debe tener minimo 3 caracteres'
                    ]
            ],
            'user_apellido'=> [
                    'rules' => 'required|min_length[3]',
                    'errors' => [
                        'required' =>'El campo {field} es obligatorio',
                        'min_length' => 'El nombre debe tener minimo 3 caracteres'
                    ]
            ],
            'user_email'=> [
                    'rules' => 'required|valid_email',
                    'errors' => [
                        'required' =>'El campo {field} es obligatorio',
                        'valid_email' => 'El correo no es valido'
                    ]
            ],
            'user_cel'=> [
                    'rules' => 'required|exact_length[10]|is_natural',
                    'errors' => [
                        'required' =>'El campo {field} es obligatorio',
                        'exact_length' => 'El numero debe contener 10 digitos.',
                        'is_natural' => 'EL numero debe contener solo digitos del 0-9.'
                    ]
            ],
            'user_password'=> [
                'rules' => 'required|min_length[8]|max_length[20]',
                'errors' => [
                    'required' =>'El campo {field} es obligatorio',
                    'min_length' => 'La contraseña debe tener al menos 8 caracteres',
                    'max_length[20]' => 'La contraseña debe tener maximo 20 caracteres'
                ]
                ],
              'repassword'=> [
                'rules' => 'required|matches[user_password]',
                'errors' => [
                    'required' =>'El campo {field} es obligatorio',
                    'matches' => 'Las contraseñas no coinciden.'
                ]
                ],
                'cuenta_id'=> [
                    'rules' => 'required',
                    'errors' => [
                        'required' =>'El campo {field} es obligatorio'
                    ]
                ],
                'est_id'=> [
                    'rules' => 'required',
                    'errors' => [
                        'required' =>'El campo {field} es obligatorio'
                    ]
                ],
                'user_rioid'=> [
                    'rules' => 'required',
                    'errors' => [
                        'required' =>'El campo {field} es obligatorio'
                    ]
                ]
        ];

        $this->reglasR = [
            'usuario'=> [
                    'rules' => 'required',
                    'errors' => [
                        'required' =>'El campo {field} es obligatorio',
                    ]
                    ],
            'password'=> [
                'rules' => 'required',
                'errors' => [
                    'required' =>'El campo {field} es obligatorio',
                ]
                ]
        ];
       
    }

    ///funcion para obtener de la base de datos los usarios activos
    public function index($activo = 1)
    {
        if(!isset($this->sesion->user_usuario)){return redirect()->to(base_url());}

        
        $db = \Config\Database::connect();
       
        //consulta punto de monitoreo
        $sql = $db->table('info_user');
        $sql->select('info_user.user_id,info_user.user_nombre,info_user.user_apellido,info_user.user_email,info_user.user_usuario,info_user.user_password,
        info_user.est_id,info_user.cuenta_id,info_user.user_cel,info_user.activo,info_user.user_rioid,
        pmonitoreo.monitoreo_id,pmonitoreo.monitoreo_nombre,pmonitoreo.activo_m,pmonitoreo.riverubi_id,pmonitoreo.est_id AS est_idm,pmonitoreo.dispositivo_id
        ,identificacion.ident_id,identificacion.ident_nombre,estado.estado_id,estado.estado_nombre,estado.active');
        $sql ->join('pmonitoreo', 'info_user.user_rioid = pmonitoreo.monitoreo_id');
        $sql ->join('estado','info_user.est_id = estado.estado_id');
        $sql ->join('identificacion','info_user.cuenta_id = identificacion.ident_id');
        $sql->where('activo', $activo);
        $query = $sql ->get();
        $resultado = $query->getResultArray();


        $data =['titulo' => 'Usuarios Activos', 'datos' => $resultado];
       
        echo view('header');
        echo view('registro/registro', $data);
        echo view('footer');
    }

    public function nuevo(){
        if(!isset($this->sesion->user_usuario)){return redirect()->to(base_url());}

        $db = \Config\Database::connect();
       
        //consulta punto de monitoreo
        // $sql = $db->table('info_user');
        // $sql->select('info_user.user_id,info_user.user_nombre,info_user.user_apellido,info_user.user_email,info_user.user_usuario,info_user.user_password,
        // info_user.est_id,info_user.cuenta_id,info_user.user_cel,info_user.activo,info_user.user_rioid');
        // $query = $sql ->get();
        // $resultado = $query->getResultArray();

        $sql2 = $db->table('estado');
        $query2 = $sql2 ->get();
        $resultado2 = $query2->getResultArray();

        $sql3 = $db->table('pmonitoreo');
        $sql3->select('pmonitoreo.monitoreo_id,pmonitoreo.monitoreo_nombre,pmonitoreo.activo_m,pmonitoreo.riverubi_id,pmonitoreo.est_id AS est_idm,pmonitoreo.dispositivo_id');
        $query3 = $sql3 ->get();
        $resultado3 = $query3->getResultArray();
        
        


        $data =['titulo' => 'Agregar Usuarios', 'datose'=>$resultado2, 'datosm' => $resultado3];

        echo view('header');
        echo view('registro/nuevo', $data);
        echo view('footer');
    }

    public function insertar(){
        if(!isset($this->sesion->user_usuario)){return redirect()->to(base_url());}

        
        if($this->request->getMethod() == 'POST' && $this->validate($this->reglas)){
        $hash = password_hash($this->request->getPost('user_password'),PASSWORD_DEFAULT);

        $this-> users ->save(['user_nombre' => $this->request->getPost('user_nombre'), 'user_apellido' => 
        $this->request->getPost('user_apellido'), 'user_email' => $this->request->getPost('user_email'), 'user_usuario' => 
        $this->request->getPost('user_usuario'), 'user_password' => $hash, 'user_cel' =>
        $this->request->getPost('user_cel'), 'cuenta_id' => $this->request->getPost('cuenta_id'),'est_id' => $this->request->getPost('est_id'),
        'user_rioid' => $this->request->getPost('user_rioid')]);
        return redirect()->to(base_url().'/registro');
       
    }else{
            // $this->validate($reglas);
            //     // Si la validación falla, imprimir errores para depuración
            //     print_r($this->validator->getErrors());
            //     die(); // Detiene la ejecución del script
            
        
        $db = \Config\Database::connect();
        $sql2 = $db->table('estado');
        $query2 = $sql2 ->get();
        $resultado2 = $query2->getResultArray();

        $sql3 = $db->table('pmonitoreo');
        $sql3->select('pmonitoreo.monitoreo_id,pmonitoreo.monitoreo_nombre,pmonitoreo.activo_m,pmonitoreo.riverubi_id,pmonitoreo.est_id AS est_idm,pmonitoreo.dispositivo_id');
        $query3 = $sql3 ->get();
        $resultado3 = $query3->getResultArray();

            $data =['titulo' => 'Agregar Usuarios', 'validation' => $this->validator, 'datose'=>$resultado2, 'datosm' => $resultado3];
            echo view('header');
            echo view('registro/nuevo', $data);
            echo view('footer');
        }
    }

    public function editar($user_id, $valid = null){
        if(!isset($this->sesion->user_usuario)){return redirect()->to(base_url());}

        $db = \Config\Database::connect();
       
        //consulta de usuario con id en especifico
        $sql = $db->table('info_user');
        $sql->select('info_user.user_id,info_user.user_nombre,info_user.user_apellido,info_user.user_email,info_user.user_usuario,info_user.user_password,
        info_user.est_id,info_user.cuenta_id,info_user.user_cel,info_user.user_rioid,
        pmonitoreo.monitoreo_id,pmonitoreo.monitoreo_nombre,estado.estado_id,estado.estado_nombre');
        $sql ->join('pmonitoreo', 'info_user.user_rioid = pmonitoreo.monitoreo_id');
        $sql ->join('estado','info_user.est_id = estado.estado_id');
        $sql->where('user_id', $user_id);
        $sql->limit(1);
        $query = $sql ->get();
        $resultado = $query->getRowArray();


        //consultas para obtener todos los datos de estado y monitoreo
        $sql2 = $db->table('estado');
        $sql2->select('estado.estado_id AS estado_idt,estado.estado_nombre AS estado_nombret');
        $query2 = $sql2 ->get();
        $resultado2 = $query2->getResultArray();

        $sql3 = $db->table('pmonitoreo');
        $sql3->select('pmonitoreo.monitoreo_id AS monitoreo_idt,pmonitoreo.monitoreo_nombre AS monitoreo_nombret');
        $query3 = $sql3 ->get();
        $resultado3 = $query3->getResultArray();

        if($valid != null){
        $data =['titulo' => 'User', 'datos' => $resultado, 'datose'=>$resultado2, 'datosm' => $resultado3, 'validation' => $valid, 'si' =>1];
        }else
        $data =['titulo' => 'User', 'datos' => $resultado, 'datose'=>$resultado2, 'datosm' => $resultado3, 'si' => 0];

        echo view('header');
        echo view('registro/editar', $data);
        echo view('footer');
    }

    public function actualizar(){
        if(!isset($this->sesion->user_usuario)){return redirect()->to(base_url());}

        if($this->request->getMethod() == 'POST' && $this->validate($this->reglasA)){
        $hash = password_hash($this->request->getPost('user_password'),PASSWORD_DEFAULT);

        $this-> users ->update($this->request->getPost('user_id'),['user_nombre' => $this->request->getPost('user_nombre'), 'user_apellido' => 
        $this->request->getPost('user_apellido'), 'user_email' => $this->request->getPost('user_email'), 'user_usuario' => 
        $this->request->getPost('user_usuario'), 'user_password' => $hash, 'user_cel' =>
        $this->request->getPost('user_cel'), 'cuenta_id' => $this->request->getPost('cuenta_id'),'est_id' => $this->request->getPost('est_id'),
        'user_rioid' => $this->request->getPost('user_rioid')]);
        return redirect()->to(base_url().'/registro');
        }else{
            // $this->validate($reglas);
            //     // Si la validación falla, imprimir errores para depuración
            //     print_r($this->validator->getErrors());
            //     die(); // Detiene la ejecución del script
           
           return $this-> editar($this->request->getPost('user_id'), $this->validator);
        }
    }

    public function eliminar($id){
        $this->users->update($id, ['activo'=> 0]);
        return redirect()->to(base_url().'/registro');
    }

    public function eliminados($activo=0){
        if(!isset($this->sesion->user_usuario)){return redirect()->to(base_url());}

        $db = \Config\Database::connect();
       
        //consulta punto de monitoreo
        $sql = $db->table('info_user');
        $sql->select('info_user.user_id,info_user.user_nombre,info_user.user_apellido,info_user.user_email,info_user.user_usuario,info_user.user_password,
        info_user.est_id,info_user.cuenta_id,info_user.user_cel,info_user.activo,info_user.user_rioid,
        pmonitoreo.monitoreo_id,pmonitoreo.monitoreo_nombre,pmonitoreo.activo_m,pmonitoreo.riverubi_id,pmonitoreo.est_id AS est_idm,pmonitoreo.dispositivo_id
        ,identificacion.ident_id,identificacion.ident_nombre,estado.estado_id,estado.estado_nombre,estado.active');
        $sql ->join('pmonitoreo', 'info_user.user_rioid = pmonitoreo.monitoreo_id');
        $sql ->join('estado','info_user.est_id = estado.estado_id');
        $sql ->join('identificacion','info_user.cuenta_id = identificacion.ident_id');
        $sql->where('activo', $activo);
        $query = $sql ->get();
        $resultado = $query->getResultArray();


        $data =['titulo' => 'Usuarios Eliminados', 'datos' => $resultado];

        echo view('header');
        echo view('registro/eliminados', $data);
        echo view('footer');
    }

    public function restaurar($id){
        $this->users->update($id, ['activo'=> 1]);
        return redirect()->to(base_url().'registro');

    }
    public function login(){
        echo view('login');
    }
    
    public function validar(){
        if($this->request->getMethod() == 'POST' && $this->validate($this->reglasR)){
               $usuario = $this->request->getPost('usuario');
               $password = $this->request->getPost('password');
               $datosUsuario = $this->users->where('user_usuario',$usuario)->first();
               if($datosUsuario != null){
                 if(password_verify($password, $datosUsuario['user_password'])){
                       $datosSesion =[
                        'user_nombre' => $datosUsuario['user_nombre'],
                        'est_id'=>$datosUsuario['est_id'],
                        'cuenta_id' => $datosUsuario['cuenta_id'],
                        'user_id' => $datosUsuario['user_id'],
                        'user_usuario' => $datosUsuario['user_usuario']
                       ];
                       $session = session();
                       $session ->set($datosSesion);
                       return redirect()->to(base_url(). '/Dashboard/index');
                 }else{
                    $data['error'] = 'La contraseña no coincide';
                echo view('login', $data);
                 }
               }else{
                $data['error'] = 'El usuario no existe';
                echo view('login', $data);
               }
        }else{
            $data =['validation' => $this->validator];
            echo view('login', $data);
        }
    }

    public function logout(){
        $sesion = session();
        $sesion ->destroy();
        return redirect()->to(base_url());
    }

    // public function cambiar_password(){

    // }o
  
}