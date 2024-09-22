<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DispositivosModel;


class Dispositivos extends BaseController
{
    protected $sesion;
    protected $users;
    public function __construct()
    {
        $this-> users = new DispositivosModel();
        $this->sesion = session();
    }

    ///funcion para obtener de la base de datos los usarios activos
    public function index($activo = 1)
    {
        //verificar si inicio sesion
        if(!isset($this->sesion->user_usuario)){return redirect()->to(base_url());}

        //Conexion a base de datos
        $db = \Config\Database::connect();

        //Consulta
        $sql = $db->table('dispositivo');
        $sql ->select('dispositivo.circuito_id, dispositivo.circuito_nombre, pmonitoreo.monitoreo_nombre, river_ubi.ubi_latitud, river_ubi.ubi_longitud, estado.estado_nombre');
        $sql ->join('pmonitoreo','dispositivo.pmonitoreo_id = pmonitoreo.monitoreo_id');
        $sql->join('river_ubi', 'dispositivo.pos_id = river_ubi.ubi_id');
        $sql->join('estado', 'dispositivo.estado_id = estado.estado_id');
        $sql->where('activo', $activo);
        $query =$sql->get();
        $resultado = $query->getResultArray();

        $data =['titulo' => 'Dispositivos', 'datos' => $resultado];

        echo view('header');
        echo view('dispositivos/dispositivos', $data);
        echo view('footer');
    }

    public function nuevo(){
        //verificar si inicio sesion
        if(!isset($this->sesion->user_usuario)){return redirect()->to(base_url());}

        $db = \Config\Database::connect();

        //Consulta
        $sql = $db->table('dispositivo');
        $sql ->select('dispositivo.circuito_id, dispositivo.circuito_nombre');
        $query =$sql->get();
        $resultado = $query->getResultArray();

        $sql2 = $db->table('estado');
        $query2 = $sql2 ->get();
        $resultado2 = $query2->getResultArray();

        $sql3 = $db->table('pmonitoreo');
        $sql3->select('*');
        $query3 = $sql3 ->get();
        $resultado3 = $query3->getResultArray();
        
        $sql4 = $db->table('river_ubi');
        $query4 = $sql4 ->get();
        $resultado4 = $query4->getResultArray();


        $data = ['titulo' => 'Agregar Dispositivo', 'datos' => $resultado, 'datose'=>$resultado2, 'datosm' => $resultado3, 'datosr' =>$resultado4];
        echo view('header');
        echo view('dispositivos/nuevo', $data);
        echo view('footer');
    }

    public function insertar(){
        if($this->request->getMethod()=='POST'){
        $this-> users ->save([
        'circuito_nombre' => $this->request->getPost('circuito_nombre'), 
        'pmonitoreo_id' =>  $this->request->getPost('pmonitoreo_id'), 
        'pos_id' => $this->request->getPost('pos_id'), 
        'estado_id' => $this->request->getPost('estado_id'),
        'sensor_id' => 1
        ]);
        return redirect()->to(base_url().'/dispositivos');
    }else{
        $this->nuevo();
    }
    }

    public function editar($circuito_id){

        //verificar si inicio sesion
        if(!isset($this->sesion->user_usuario)){return redirect()->to(base_url());}

        $db = \Config\Database::connect();

        //Consulta con filtro
        $sql = $db->table('dispositivo');
        $sql ->select('dispositivo.circuito_id, dispositivo.circuito_nombre, dispositivo.sensor_id, pmonitoreo.monitoreo_nombre,pmonitoreo.monitoreo_id, 
        river_ubi.ubi_latitud, river_ubi.ubi_longitud, estado.estado_nombre,estado.estado_id, river_ubi.ubi_id');
        $sql ->join('pmonitoreo','dispositivo.pmonitoreo_id = pmonitoreo.monitoreo_id');
        $sql->join('river_ubi', 'dispositivo.pos_id = river_ubi.ubi_id');
        $sql->join('estado', 'dispositivo.estado_id = estado.estado_id');
        $sql->where('dispositivo.circuito_id', $circuito_id);
        $sql->limit(1);
        $query =$sql->get();
        $resultado = $query->getRowArray();

        // sin filtro
         //consultas para obtener todos los datos de estado y monitoreo
         $sql2 = $db->table('estado');
         $sql2->select('estado.estado_id AS estado_idt,estado.estado_nombre AS estado_nombret');
         $query2 = $sql2 ->get();
         $resultado2 = $query2->getResultArray();
 
         $sql3 = $db->table('pmonitoreo');
         $sql3->select('pmonitoreo.monitoreo_id AS monitoreo_idt,pmonitoreo.monitoreo_nombre AS monitoreo_nombret');
         $query3 = $sql3 ->get();
         $resultado3 = $query3->getResultArray();

         $sql4 = $db->table('river_ubi');
         $sql4->select('river_ubi.ubi_latitud AS ubi_latitudt, river_ubi.ubi_longitud AS ubi_longitudt, river_ubi.ubi_id AS ubi_idt');
         $query4 = $sql4 ->get();
         $resultado4 = $query4->getResultArray();


        $data = ['titulo' => 'Editar dispositivo', 'datosi' => $resultado, 'datose' => $resultado2, 'datosm' => $resultado3, 'datosr' => $resultado4];

        echo view('header');
        echo view('dispositivos/editar', $data);
        echo view('footer');
    }

    public function actualizar(){

        $this-> users ->update($this->request->getPost('circuito_id'),['circuito_nombre' => $this->request->getPost('circuito_nombre'), 'pmonitoreo_id' => 
        $this->request->getPost('pmonitoreo_id'), 'pos_id' => $this->request->getPost('pos_id'), 'estado_id' => 
        $this->request->getPost('estado_id')]);
        return redirect()->to(base_url().'/dispositivos');
    }

    public function eliminar($id){
        $this->users->update($id, ['activo'=> 0]);
        return redirect()->to(base_url().'/dispositivos');
    }

    public function eliminados($activo=0){
        //verificar si inicio sesion
        if(!isset($this->sesion->user_usuario)){return redirect()->to(base_url());}

       //Conexion a base de datos
       $db = \Config\Database::connect();

       //Consulta
       $sql = $db->table('dispositivo');
       $sql ->select('dispositivo.circuito_id, dispositivo.circuito_nombre, pmonitoreo.monitoreo_nombre, river_ubi.ubi_latitud, river_ubi.ubi_longitud, estado.estado_nombre');
       $sql ->join('pmonitoreo','dispositivo.pmonitoreo_id = pmonitoreo.monitoreo_id');
       $sql->join('river_ubi', 'dispositivo.pos_id = river_ubi.ubi_id');
       $sql->join('estado', 'dispositivo.estado_id = estado.estado_id');
       $sql->where('activo', $activo);
       $query =$sql->get();
       $resultado = $query->getResultArray();

       $data =['titulo' => 'Dispositivos Eliminados', 'datos' => $resultado];

        echo view('header');
        echo view('dispositivos/eliminados', $data);
        echo view('footer');
    }

    public function restaurar($id){
        $this->users->update($id, ['activo'=> 1]);
        return redirect()->to(base_url().'dispositivos');

    }
}