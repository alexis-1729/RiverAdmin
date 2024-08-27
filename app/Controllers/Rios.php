<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\RiosModel;


class Rios extends BaseController
{

    protected $users;
    protected $sesion;
    public function __construct()
    {
        $this-> users = new RiosModel();
        $this->sesion = session();
    }

    ///funcion para obtener de la base de datos los usarios activos
    public function index($activo = 1)
    {
        if(!isset($this->sesion->user_usuario)){return redirect()->to(base_url());}

        $db = \Config\Database::connect();
       
        //consulta punto de monitoreo
        $sql = $db->table('pmonitoreo');
        $sql->select('pmonitoreo.monitoreo_id, pmonitoreo.monitoreo_nombre, river_ubi.ubi_latitud, river_ubi.ubi_longitud, estado.estado_nombre, estado.estado_id');
        $sql ->join('river_ubi', 'pmonitoreo.riverubi_id = river_ubi.ubi_id');
        $sql ->join('estado','pmonitoreo.est_id = estado.estado_id');
        $sql->where('activo_m', $activo);
        $query = $sql ->get();
        $resultado = $query->getResultArray();


        $data =['titulo' => 'Rios', 'datosp' => $resultado];

        echo view('header');
        echo view('rios/rios', $data);
        echo view('footer');
    }

    public function nuevo(){
        if(!isset($this->sesion->user_usuario)){return redirect()->to(base_url());}

        $db = \Config\Database::connect();
       
        //consulta punto de monitoreo
        $sql = $db->table('pmonitoreo');
        $sql->select('pmonitoreo.monitoreo_id,pmonitoreo.est_id, pmonitoreo.riverubi_id, pmonitoreo.monitoreo_nombre');
        $query = $sql ->get();
        $resultado = $query->getResultArray();

        $sql2 = $db->table('estado');
        $query2 = $sql2 ->get();
        $resultado2 = $query2->getResultArray();

        $sql4 = $db->table('river_ubi');
        $query4 = $sql4 ->get();
        $resultado3 = $query4->getResultArray();

        $data = ['titulo' => 'Agregar Rio', 'datos' => $resultado, 'datose'=> $resultado2, 'datosr'=> $resultado3];
        echo view('header');
        echo view('rios/nuevo', $data);
        echo view('footer');
    }

    public function insertar(){
        $this-> users ->save(['monitoreo_nombre' => $this->request->getPost('monitoreo_nombre'), 'riverubi_id'=>$this->request->getPost('riverubi_id'), 'est_id' => $this->request->getPost('est_id')]);
        return redirect()->to(base_url().'rios');
    }

    public function editar($user_id){
        if(!isset($this->sesion->user_usuario)){return redirect()->to(base_url());}


        $db = \Config\Database::connect();
       
        //consulta punto de monitoreo
        $sql = $db->table('pmonitoreo');
        $sql->select('pmonitoreo.monitoreo_id, pmonitoreo.monitoreo_nombre,pmonitoreo.riverubi_id,pmonitoreo.est_id, river_ubi.ubi_latitud, 
        river_ubi.ubi_longitud, estado.estado_nombre, estado.estado_id, river_ubi.ubi_id');
        $sql ->join('river_ubi', 'pmonitoreo.riverubi_id = river_ubi.ubi_id');
        $sql ->join('estado','pmonitoreo.est_id = estado.estado_id');
        $sql ->where('monitoreo_id', $user_id);
        $sql->limit(1);
        $query = $sql ->get();
        $resultado = $query->getRowArray();

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


        $data = ['titulo' => 'Editar Rio', 'datosi' => $resultado, 'datose'=>$resultado2, 'datosm' => $resultado3, 'datosr' =>$resultado4];
        
        echo view('header');
        echo view('rios/editar', $data);
        echo view('footer');
    }

    public function actualizar(){

        $this-> users ->update($this->request->getPost('monitoreo_id'),['monitoreo_nombre' => $this->request->getPost('monitoreo_nombre'),'riverubi_id' => $this->request->getPost('riverubi_id'), 'est_id' =>$this->request->getPost('est_id')]);
        return redirect()->to(base_url().'/rios');
    }

    public function eliminar($id){
        $this->users->update($id, ['activo_m'=> 0]);
        return redirect()->to(base_url().'/rios');
    }

    public function eliminados($active=0){

        if(!isset($this->sesion->user_usuario)){return redirect()->to(base_url());}

        $db = \Config\Database::connect();
       
        //consulta punto de monitoreo
        $sql = $db->table('pmonitoreo');
        $sql->select('pmonitoreo.monitoreo_id, pmonitoreo.monitoreo_nombre, river_ubi.ubi_latitud, river_ubi.ubi_longitud, estado.estado_nombre, estado.estado_id');
        $sql ->join('river_ubi', 'pmonitoreo.riverubi_id = river_ubi.ubi_id');
        $sql ->join('estado','pmonitoreo.est_id = estado.estado_id');
        $sql->where('activo_m', $active);
        $query = $sql ->get();
        $resultado = $query->getResultArray();


        $data =['titulo' => 'Rios Eliminados', 'datosp' => $resultado];

        echo view('header');
        echo view('rios/eliminados', $data);
        echo view('footer');
    }

    public function restaurar($id){
        $this->users->update($id, ['activo_m'=> 1]);
        return redirect()->to(base_url().'rios');

    }
}