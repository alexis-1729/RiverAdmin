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
use Firebase\JWT\JWT;


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
protected $sesion;
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
    $this->sesion=session();
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
                        'fcm_token' => bin2hex(openssl_random_pseudo_bytes(16)) // Método para generar un token
                    )
                );
                $session = session();
                $session ->set($response['data']);
            }else{
                $response = array(
                    'status' => 'error',
                    'message' => 'Contraseña incorrecta'
                );
            }  
       }else{
        $response = array(
            'status' => 'error',
            'message' => 'El usuario no existe'
        );
       }
    }else{
        //enviar errores
        $response = array(
            'status' => 'error',
            'message' => 'Llene los requerimientos'
        );
    }
  }else{
    $response = array(
        'status' => 'error',
        'message' => 'Error en el post'
    );
  }
  return $this->response->setJSON($response);
}

public function logout(){
    $sesion = session();
    $sesion ->destroy();
    $response = array(
        'status' => 'success',
        'message' => 'sesion cerrada'
    );
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
        // $response = array(
        //     'status' => 'success',
        //     'message' => 'Operacion saveSensor correcta'
        // );
        // return $this->response->setJSON($response);
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
 //Asginacion de token 
  public function associateToken() {
    $userId = $this->request->getVar('userId');
   // $token =$this->request->getVar('token');
    //---------------------------------
    $key = "ramanu";  // Define una clave secreta segura para firmar el token
    $issuedAt = time();        // Tiempo actual
    $expirationTime = $issuedAt + 3600;  // El token expirará en 1 hora
    $payload = array(
        'userId' => $userId,
        'iat' => $issuedAt,      // Tiempo en el que fue generado
        'exp' => $expirationTime // Tiempo de expiración
    );

    // Genera el JWT con la clave secreta
    $token = JWT::encode($payload, $key, 'HS256');

   $datos = $this->api->where('user_id', $userId)->first();
   if($datos != null){
   

     $this->api->update($userId, ['fcm_token' => $token]);
       
    
        $response = array(
            'status' => 'success',
            'message' => 'Operacion token correcta'    
          );
        
        return $this->response->setJSON($response);
   }else{
    return $this->response->setJSON(['status' => 'error']);
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
        $filePath = APPPATH . '../config/serviceAccountKey.json';
        $jwt = generate_fcm_jwt($filePath);
        //'c:\Users\alexis-1729\Documents\keyAPI\riversafe-4bb22-1f66a3ba0030.json'
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
            //funcio de civil para crear y enviar mensaje a admin de rio 
             $id = $this->request->getVar('user');
             $rio = $this->request ->getVar('rio');
             $mensaje = $this->request->getVar('mensaje');
             $titulo = $this->request->getVar('titulo');
            //identifico al admin de rio
             $admin = $this ->api 
            -> select('user_id')
            -> where('user_rioid', $rio)
            ->where('cuenta_id', 1)
            -> first();

                 $this->mensajes->save([
                 'user_id' => $id, 
                 'user_admin' =>$admin, 
                 'mensaje' => $mensaje,
                 'titulo' => $titulo]);
                 $response = array(
                     'status' => 'success',
                     'message' => 'Mensaje registrado'
                 );
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
            $id = $this->request->getVar('user');
            $rio = $this ->request ->getvar('rio_id');

            //  verificar si el user es un admin
            $admin = $this->api
            -> select('user_id')
            -> where('user_id', $id) 
            -> where('cuenta_id', 1)
            -> first();

            //si es nulo no es admin
            if($admin == null){
            //si el user no es admin entonces busco el admin mediante el user
            $admin = $this->api
            -> select('user_id')
            -> where('user_rioid', $rio) 
            -> where('cuenta_id', 1)
            -> first();

            //encontrar los mensajes que tengan en comun el usuario y el admin al que pertence el rio
            $datos = $this ->mensajes 
            ->where('user_id', $id)
            ->where('revisado', 1)
            ->where('user_admin', $admin) 
            ->findAll();

            }else{
            //encaso de ser admin que cargue todos los mensajes que contega el admin 
            // $datos = $this ->mensajes 
            // ->groupStart()
            //     ->where('user_id', $id)
            //     ->where('user_admin', $id)
            // ->groupEnd()
            // ->where('revisado', 1)
            // ->findAll();

            $datos = $this ->mensajes 
            ->where('user_admin', $id)
            ->where('revisado', 1)
            ->findAll();
        }

            //obtengo los user_id de los mensajes
             $user_ids = array_column($datos, 'user_id');
             $user_ids = array_unique($user_ids);

            
             //obtengo el username con los user_id
             $usernames = $this->api->whereIn('user_id', $user_ids)->findAll();

              $username_id =[];

              //asingno a cada user_id su username respectivo
              foreach ($usernames as $us){
                  $username_id[$us['user_id']] = $us['user_usuario'];
              }

              foreach($datos as &$mensaje){
                  $user_id = $mensaje['user_id'];
                 $mensaje['username'] = isset($username_id[$user_id]) ? $username_id[$user_id] : 'Usuario desconocido';
              }

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
    //agregar la pagina de riversafe al river Admin

    
    public function experimentacion(){

        $id = $this->request->getVar('user');
        $rio = $this ->request ->getvar('rio_id');

        //  verificar si el user es un admin
        $admin = $this->api
        -> select('user_id')
        -> where('user_id', $id) 
        -> where('cuenta_id', 1)
        -> first();

        //si es nulo no es admin
        if($admin == null){
        //si el user no es admin entonces busco el admin mediante el user
        $admin = $this->api
        -> select('user_id')
        -> where('user_rioid', $rio) 
        -> where('cuenta_id', 1)
        -> first();

        //encontrar los mensajes que tengan en comun el usuario y el admin al que pertence el rio
        $datos = $this ->mensajes 
        ->where('user_id', $id)
        ->where('revisado', 1)
        ->where('user_admin', $admin) 
        ->findAll();

        }else{
        //encaso de ser admin que cargue todos los mensajes que contega el admin 
       

        $datos = $this ->mensajes 
        ->where('user_admin', $id)
        ->where('revisado', 1)
        ->findAll();
    }

        //obtengo los user_id de los mensajes
         $user_ids = array_column($datos, 'user_id');
         $user_ids = array_unique($user_ids);

        
         //obtengo el username con los user_id
         $usernames = $this->api->whereIn('user_id', $user_ids)->findAll();

          $username_id =[];

          //asingno a cada user_id su username respectivo
          foreach ($usernames as $us){
              $username_id[$us['user_id']] = $us['user_usuario'];
          }

          foreach($datos as &$mensaje){
              $user_id = $mensaje['user_id'];
             $mensaje['username'] = isset($username_id[$user_id]) ? $username_id[$user_id] : 'Usuario desconocido';
          }

          foreach($datos as $mensajes){
             echo $mensajes['username'];
          }

        


    }
   //respondiendo un mensjae añadir 
    public function responderMensaje(){
        if($this->request->getMethod() == 'POST'){
            //id del mensaje al cual se le va a responder
            $id = $this->request->getVar('id');
            //id del usuario quien lo envia
            $user = $this ->request -> getVar('user_id');
            //rio del cual genera el mensaje
            $rio = $this -> request ->getVar('rio_id');
            $titulo = $this ->request ->getVar('titulo');
            $mensaje = $this -> request ->getVar('mensaje');
           
           $dat = $this->api->where('user_rioid', $rio) -> where('cuenta_id', 1) -> first();
           
           if($dat != null){
            $this -> mensajes -> save([
                'mensaje' => $mensaje,
                'user_id' => $user,
                'user_admin' => $dat['user_id'],
                'titulo' => $titulo,
                'id_respond' => $id 
                ]);

                $response = array(
                    'status' => 'success',
                    'message' => 'Operacion respondewr mensaje correcta'
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
    public function getName(){
        if($this->request->getMethod() == 'POST'){
            $id = $this->request->getVar('user_id');
            $datos = $this ->api ->where('user_id', $id)->first();
            if($datos != NULL){
                //si existe remplazar con los nuevos datos
                $this->mensajes->update($id,[ 
                'revisado' => 1]);
                $response = array(
                    'status' => 'success',
                    'message' => 'Usuario encontrado',
                    'data' => array(
                        'username' => $datos['user_usuario'],
                        'user_rioid' => $datos['user_rioid'],
                        // Método para generar un token
                    )
                );
            }else{
                $response = array(
                    'status' => 'error',
                    'message' => 'usuario no encontrado'
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

    public function mediaNiv(){
        //------
        $valores = [];
        for($i = 0; $i < 5; $i++){
            $aux = $this -> request -> getVar("sens_nivel$i");
            if($aux != null)
            $valores[] = (float) $aux;
        }

        $parametros = implode(" ", $valores);
        $command = escapeshellcmd("python Scripts/media.py $parametros");

        $output = shell_exec($command);

        $result = json_decode($output, true);

        if($result != null){
            return $this->response->setJSON($result);
        }else return $this ->response ->setJSON(['error' => 'Error en la ejecucion del script']);

    }

    

    //---- Calculando la varianza

    public function varianzaNiv(){
        $datos = [];

        for($i = 0; $i < 5; $i++){
            $aux = $this -> request -> getVar("sens_nivel$i");
            if($aux != null){
                $datos [] = (float)$aux;
            }
        }

        $parametros = implode(" ", $datos);
        $command = escapeshellcmd("python Scripts/varianza.py $parametros");
        $output = shell_exec($command);
        $result = json_decode($output, true);
        if($result != null){
            return $this ->response ->setJSON($result);
        }else return $this -> response ->setJSON(["error" => 'Error en la ejecucion del script']);
    }
}
?>