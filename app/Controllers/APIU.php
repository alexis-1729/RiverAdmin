<?php
namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\APIUModel;
use App\Models\DispositivosModel;
use App\Models\MensajeModel;
use App\Models\RiosModel;
use App\Models\SensorModel;
use App\Models\UbiModel;
use App\Models\UserposModel;


class APIU extends BaseController{
protected $reglasR;
protected $reglas;
protected $api;
protected $rio;
protected $dispositivos;
protected $sensor;
protected $ubic;
protected $userpos;
protected $mensajes;
public function __construct()
{
   

    helper('token');

    $this-> api = new APIUModel();
    $this->rio = new RiosModel();
    $this->dispositivos = new DispositivosModel();
    $this->sensor = new SensorModel;
    $this->ubic = new UbiModel();
    $this->userpos = new UserposModel();
    $this->mensajes = new MensajeModel();
    $this->reglasR = [
        'username'=> 'required',
        'password'=> 'required'
    ];

    //reglas para registro
    $this->reglas = [
        'name'=>  'required|min_length[3]',
               
        'username'=>  'required|min_length[3]',
                
        'apellido'=>  'required|min_length[3]',
                
        'email'=>  'required|valid_email|is_unique[info_user.user_email]',
                
        'celular'=>  'required|exact_length[10]|is_natural',
                
        'password'=>  'required|min_length[8]|max_length[20]',
          
          'repassword'=>  'required|matches[password]',
           
            'cuenta_id'=>  'required',
                
            'est_id'=>  'required',

            'rioid'=> 'required'      
    ];
}
public function index(){
}

public function login(){
    //validacion del metodo post y reglas de los valores user y password
    if($this->request->getMethod() == 'POST'){
        if($this->validate($this->reglasR)){
      $user = $this ->request->getVar('username');
       $password = $this ->request ->getVar('password');
      $datos = $this->api->where('user_usuario',$user)->first();
       if($datos != NULL){
            if(password_verify($password, $datos['user_password'])){
                $response = array(
                    'status' => 'success',
                    'message' => 'Login successful',
                    'data' => array(
                        'user_id' => $datos['user_id'],
                        'username' => $datos['user_usuario'],
                        'cuenta_id' => $datos['cuenta_id'],
                        'est_id' => $datos['est_id'],
                        'user_rioid' => $datos['user_rioid'],
                        'user_nombre' => $datos['user_nombre'],
                        'user_email' => $datos['user_email'],
                        'user_apellido' => $datos['user_apellido'],
                        'token' => bin2hex(openssl_random_pseudo_bytes(16)) // Método para generar un token
                    )
                );
            }else{
                $response = array(
                    'status' => 'error',
                    'message' => 'Contraseña o correo incorrectos'
                );
            }  
       }else{
        $response = array(
            'status' => 'error',
            'message' => 'El usuario no existe'
        );
       }
    }else{
        $response = array(
            'status' => 'error',
            'message' => 'Llene los requerimientos'
        );
    }
  }else{
    $response = array(
        'status' => 'error',
        'message' => 'Erro en el post'
    );
  }
  return $this->response->setJSON($response);
}

public function obtenerRios(){
    if($this->request->getMethod() == 'POST'){
        $rioid = $this->request->getVar('rioid');
        $datos = $this ->rio ->where('monitoreo_id', $rioid)->first();
        if($datos != NULL){
            $response = array(
                    'status' => 'success',
                    'message' => 'Operacion getRio correcta',
                    'data' => array(
                        'monitoreo_nombre' => $datos['monitoreo_nombre'],
                        'riverubi_id' => $datos['riverubi_id'],
                        'est_id' => $datos['est_id'],
                        'token' => bin2hex(openssl_random_pseudo_bytes(16)) // Método para generar un token
                    )
                );
        }else{
            $response = array(
                'status' => 'error',
                'message' => 'id no encontrado'
            );
        }
    }else{
        $response = array(
            'status' => 'error',
            'message' => 'Error en el metodo post'
        );
    }
    return $this->response->setJSON($response);
}

public function obtenerListaRios(){
    $datos = $this-> rio -> findAll();
    if($datos != null){
        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Lista de ríos obtenida correctamente',
            'data' => $datos
        ]);
    }else {
        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'No se encontraron ríos en la base de datos',
            'data' => []
        ]);
    }
}

public function registrar(){
    if($this->request->getMethod() == 'POST'){
        if($this->validate($this->reglas)){
        $hash = password_hash($this->request->getVar('password'),PASSWORD_DEFAULT);
        $this-> api ->save(['user_nombre' => $this->request->getVar('name'), 'user_apellido' => 
        $this->request->getVar('apellido'), 'user_email' => $this->request->getVar('email'), 'user_usuario' => 
        $this->request->getVar('username'), 'user_password' => $hash, 'user_cel' =>
        $this->request->getVar('celular'), 'cuenta_id' => $this->request->getVar('cuenta_id'),'est_id' => $this->request->getVar('est_id'),
        'user_rioid' => $this->request->getVar('rioid')]);
        $response = array(
            'status' => 'success',
            'message' => 'Registro realizado correctamente',
            'data' => array(
                        'username' => $this->request->getVar('username'),
                        'cuenta_id' => $this->request->getVar('cuenta_id'),
                        'est_id' => $this->request->getVar('est_id'),
                        'user_rioid' => $this->request->getVar('rioid'),
                        'user_nombre' => $this->request->getVar('name'),
                        'user_email' => $this->request->getVar('email'),
                        'user_apellido' => $this->request->getVar('apellido'),
                        'token' => bin2hex(openssl_random_pseudo_bytes(16)) // Método para generar un token
                    )
        );

        }else{
            $response = array(
                'status' => 'error',
                'message' => 'Los datos proporcionado no cumplen los requerimientos'
            );
        }
    }else{
        $response = array(
            'status' => 'error',
            'message' => 'Error en el metodo post'
        );
    }
    return $this->response->setJSON($response);
}

public function getDispositivos(){
    if($this->request->getMethod() == 'POST'){
        $monitor = $this->request->getVar('monitoreo_id');
        $datos = $this ->dispositivos ->where('pmonitoreo_id', $monitor)->findAll();
        if($datos != NULL){
            $sensorIds = array_map(function($item) {
                return $item['sensor_id'];
            }, $datos);
            
            $response = array(
                    'status' => 'success',
                    'message' => 'Operacion getDispositivos correcta',
                    'data' => $sensorIds
                    
                );
        }else{
            $response = array(
                'status' => 'error',
                'message' => 'id no encontrado'
            );
        }
    }else{
        $response = array(
            'status' => 'error',
            'message' => 'Error en el metodo post'
        );
    }
    return $this->response->setJSON($response);
    }

    public function obtenerubi(){
        if($this->request->getMethod() == 'POST'){
            $ubi = $this->request->getVar('riverubi_id');
            $datos = $this ->ubic ->where('ubi_id', $ubi)->first();
            if($datos != NULL){
                $response = array(
                        'status' => 'success',
                        'message' => 'Operacion getubi correcta',
                        'data' => $datos
                    );
            }else{
                $response = array(
                    'status' => 'error',
                    'message' => 'id no encontrado'
                );
            }
        }else{
            $response = array(
                'status' => 'error',
                'message' => 'Error en el metodo post'
            );
        }
        return $this->response->setJSON($response);
    }

    public function obtenSensorDia(){
        if($this->request->getMethod() == 'POST'){
            $ubi = $this->request->getVar('sensor_id');
            $inicio = date('Y-m-d 00:00:00');
            $fin = date('Y-m-d 23:59:59');
            $fechaHoy = date('Y-m-d');
            $datos = $this ->sensor ->where('ard_id', $ubi)
                                    ->where('DATE(sens_fecha)', $fechaHoy)
                                    ->findAll();
            if($datos != NULL){
                $response = array(
                        'status' => 'success',
                        'message' => 'Operacion getSensor correcta',
                        'data' => $datos
                    );
            }else{
                $response = array(
                    'status' => 'error',
                    'message' => 'id no encontrado o no hay registro para el dia'
                );
            }
        }else{
            $response = array(
                'status' => 'error',
                'message' => 'Error en el metodo post'
            );
        }
        return $this->response->setJSON($response);
    }

    ///Agregar el post de la hora para tener control de los sensores por hora
    public function obtenSensorHora(){
        if($this->request->getMethod() == 'POST'){
            $ubi = $this->request->getVar('sens_id');
            $inicio = date('Y-m-d 00:00:00');
            $fin = date('Y-m-d 23:59:59');
            $fechaHoy = date('Y-m-d');
            $datos = $this ->sensor ->where('ard_id', $ubi)
                                    ->where('sens_fecha >=', $inicio)
                                    ->where('sens_fecha <=', $fin)
                                    ->findAll();
            if($datos != NULL){
                $response = array(
                        'status' => 'success',
                        'message' => 'Operacion getSensor correcta',
                        'data' => $datos
                    );
            }else{
                $response = array(
                    'status' => 'error',
                    'message' => 'id no encontrado o no hay registro para el dia'
                );
            }
        }else{
            $response = array(
                'status' => 'error',
                'message' => 'Error en el metodo post'
            );
        }
        return $this->response->setJSON($response);
    }

//update se conecta con el arduino
    public function updateSensor(){
        $this->sensor->save([
            'sens_nivel' => $this->request->getVar('sens_nivel'),
            'sens_temp' => $this->request->getVar('sens_temp'),
            'sens_vel' => $this->request->getVar('sens_vel'),
            'ard_id' =>$this->request->getVar('ard_id')
        ]);
        $response = array(
            'status' => 'success',
            'message' => 'Operacion saveSensor correcta'
        );
        return $this->response->setJSON($response);
    }

    //actualiza o guarda posicion del usuario
    public function saveUserpos(){
        if($this->request->getMethod() == 'POST'){
            $id = $this->request->getVar('user_id');
            $lat = $this ->request->getVar('latitud');
            $lng = $this ->request->getVar('longitud');
            $datos = $this ->userpos ->where('user_id', $id)->first();
            if($datos != NULL){
                //si existe remplazar con los nuevos datos
                $this->userpos->update($datos['userpos_id'],[ 
                'latitud' =>$lat, 
                'longitud' => $lng]);
                $response = array(
                    'status' => 'success',
                    'message' => 'Posicion actualizada'
                );
            }else{
                $this->userpos->save(['user_id' => $id, 
                'latitud' =>$lat, 
                'longitud' => $lng, 
                'alerta' => 0]);
                $response = array(
                    'status' => 'success',
                    'message' => 'Posicion registrada'
                );
            }
        }else{
            $response = array(
                'status' => 'error',
                'message' => 'Error en el metodo post'
            );
        }
        return $this->response->setJSON($response);
    }



    //obten userpos meidante id de user
        public function getUserpos(){
            if($this->request->getMethod() == 'POST'){
                $id = $this->request->getVar('user_id');
                $datos = $this ->userpos ->where('user_id', $id)->first();
                if($datos != NULL){
                    $response = array(
                            'status' => 'success',
                            'message' => 'Operacion getUserpos correcta',
                            'data' => $datos
                        );
                }else{
                    $response = array(
                        'status' => 'error',
                        'message' => 'id no encontrado'
                    );
                }
            }else{
                $response = array(
                    'status' => 'error',
                    'message' => 'Error en el metodo post'
                );
            }
            return $this->response->setJSON($response);
        }

        //obtengo user por estado

        public function getUserest(){
            if($this->request->getMethod() == 'POST'){
                $id = $this->request->getVar('est_id');
                $datos = $this ->api ->where('est_id', $id)->findAll();
                if($datos != NULL){
                    $response = array(
                            'status' => 'success',
                            'message' => 'Operacion getUserest correcta',
                            'data' => $datos
                        );
                }else{
                    $response = array(
                        'status' => 'error',
                        'message' => 'id no encontrado'
                    );
                }
            }else{
                $response = array(
                    'status' => 'error',
                    'message' => 'Error en el metodo post'
                );
            }
            return $this->response->setJSON($response);
        }

        //inserta un id en alerta para notificar al usuario
        public function idalert(){
            if($this->request->getMethod() == 'POST'){
                $id = $this->request->getVar('user_id');
                $datos = $this ->userpos ->where('user_id', $id)->first();
                if($datos != NULL){
                    //si existe remplazar con los nuevos datos
                    $this->userpos->update(['user_id' => $id, 
                    'latitud' =>$datos['latitud'], 
                    'longitud' => $datos['longitud'], 
                    'alerta' => 1]);
                    $response = array(
                        'status' => 'success',
                        'message' => 'Posicion actualizada'
                    );
                }else{
                    $response = array(
                        'status' => 'error',
                        'message' => 'Error usuario no encontrado'
                    );
                }
            }else{
                $response = array(
                    'status' => 'error',
                    'message' => 'Error en el metodo post'
                );
            }
            return $this->response->setJSON($response);
        }
//---------------------------------------------------------------------------

public function associateToken() {
    if($this->request->getMethod() == 'POST'){
    $userId = $this->request->getVar('userId');
    $token = $this->request->getVar('token');

   $datos = $this->api->where('user_id', $userId)->first();
   if($datos != null){
   

     $this->api->update($userId, ['fcm_token' => $token]);
       
    
        $response = array(
            'status' => 'success',
            'message' => 'Operacion getUserest correcta'    
          );
        
        return $this->response->setJSON($response);
   }else{
    return $this->response->setJSON(['status' => 'error']);
   }
  }else{
    return $this->response->setJSON(['status' => 'error en el post']);
  }
}

  //Envio de notificaciones
  public function sendPushNotification()
  {
      $userIds = $this->request->getVar('userIds'); // Se espera un array de IDs de usuarios
      $messageTitle = $this->request->getVar('title');
      $messageBody = $this->request->getVar('body');


      // Obtener los tokens FCM de los usuarios
      $users = $this->api->where('user_id', $userIds)->findAll();

      foreach ($users as $user) {
          if (!empty($user['fcm_token'])) {
              // Enviar notificación push a cada token
              $this->sendNotification($user['fcm_token'], $messageTitle, $messageBody);
          }
      }
      $response = array(
        'status' => 'success',
        'message' => 'Notificaciones enviadas con éxito'
    );

      return $this->response->setJSON($response);
  }

  private function sendNotification($to, $title, $body)
    {
        $jwt = generate_fcm_jwt('c:\Users\alexis-1729\Documents\keyAPI\riversafe-4bb22-1f66a3ba0030.json');
    
        $headers = array(
            'Authorization: Bearer ' . $jwt,
            'Content-Type: application/json'
        );
    
        $notification = array(
            "message" => array(
                "token" => $to,
                "notification" => array(
                    "title" => $title,
                    "body" => $body
                )
            )
        );
    
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/v1/projects/riversafe-4bb22/messages:send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($notification));
    
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }
    
        curl_close($ch);
        return $result;
    }

    //-----------------------------------------------------
    public function crearMensaje(){
         if($this->request->getMethod() == 'POST'){
             $id = $this->request->getVar('user');
             $rio = $this->request ->getVar('rio');
             $mensaje = $this->request->getVar('mensaje');
             $titulo = $this->request->getVar('titulo');
             $dat= $this->api->where('user_rioid', $rio)->first();
           
              if($dat != null){
                 $this->mensajes->save(['user_id' => $id, 
                 'user_admin' =>$dat['user_id'], 
                 'mensaje' => $mensaje,
                'titulo' => $titulo]);
                 $response = array(
                     'status' => 'success',
                     'message' => 'Mensaje registrado'
                 );
                }else{
                    $response = array(
                        'status' => 'error',
                        'message' => 'Error usuario no encontrado'
                    );
                }
         }else{
             $response = array(
                 'status' => 'error',
                 'message' => 'Error en el metodo post'
             );
         }
         return $this->response->setJSON($response);
    }

    public function listaMensaje(){
        if($this->request->getMethod() == 'POST'){
            $id = $this->request->getVar('admin');
            $datos = $this ->mensajes ->where('user_id', $id)->findAll();
            if($datos != NULL){
                $response = array(
                        'status' => 'success',
                        'message' => 'Operacion getMensajes correcta',
                        'data' => $datos
                    );
            }else{
                $response = array(
                    'status' => 'error',
                    'message' => 'id no encontrado'
                );
            }
        }else{
            $response = array(
                'status' => 'error',
                'message' => 'Error en el metodo post'
            );
        }
        return $this->response->setJSON($response);
    }

    public function eliminarMensaje(){

    }

    public function responderMensaje(){
        if($this->request->getMethod() == 'POST'){
            $id = $this->request->getVar('id');
            $datos = $this ->mensajes ->where('id_mensaje', $id)->first();
            if($datos != NULL){
                //si existe remplazar con los nuevos datos
                $this->mensajes->update($id,[ 
                'revisado' => 1]);
                $response = array(
                    'status' => 'success',
                    'message' => 'Mensaje revisado'
                );
            }else{
                $response = array(
                    'status' => 'error',
                    'message' => 'Error mensaje no encontrado'
                );
            }
        }else{
            $response = array(
                'status' => 'error',
                'message' => 'Error en el metodo post'
            );
        }
        return $this->response->setJSON($response);
    }
}
?>