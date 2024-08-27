<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MonitoreoModel;


class Monitoreo extends BaseController
{

    protected $users;
    protected $sesion;
    public function __construct()
    {
        $this-> users = new MonitoreoModel();
        $this->sesion = session();
    }

    ///funcion para obtener de la base de datos los usarios activos
    public function index($active = 1)
    {
        if(!isset($this->sesion->user_usuario)){return redirect()->to(base_url());}
        
        $db =\Config\Database::connect();
        $sql = $db->table('pmonitoreo');
        $sql -> select('pmonitoreo.monitoreo_id, pmonitoreo.monitoreo_nombre, pmonitoreo.riverubi_id, 
        pmonitoreo.est_id,pmonitoreo.dispositivo_id, estado.estado_nombre, river_ubi.ubi_longitud, river_ubi.ubi_latitud');
        $sql ->join('estado', 'pmonitoreo.est_id = estado.estado_id');
        $sql ->join('river_ubi', 'pmonitoreo.riverubi_id = river_ubi.ubi_id');
        $sql->where('activo_m', $active);
        $query = $sql ->get();
        $resultado = $query ->getResultArray();

        $data =['titulo' => 'Rios Monitoreados', 'datos' => $resultado];

        echo view('header');
        echo view('monitoreo/monitoreo', $data);
        echo view('footer');
    }

    public function observar($rio_id){
        if(!isset($this->sesion->user_usuario)){return redirect()->to(base_url());}


        $db = \Config\Database::connect();
        $sql = $db ->table('dispositivo');
        $sql ->select('dispositivo.circuito_id, dispositivo.circuito_nombre,dispositivo.sensor_id, pmonitoreo.monitoreo_nombre,pmonitoreo.monitoreo_id, 
        river_ubi.ubi_latitud, river_ubi.ubi_longitud, estado.estado_nombre,estado.estado_id, river_ubi.ubi_id');
        $sql->join('estado', 'dispositivo.estado_id = estado.estado_id');
        $sql->join('river_ubi', 'dispositivo.pos_id = river_ubi.ubi_id');
        $sql->join('pmonitoreo', 'dispositivo.pmonitoreo_id = pmonitoreo.monitoreo_id');
        $sql->where('dispositivo.pmonitoreo_id', $rio_id);
        $query = $sql ->get();
        $resultado = $query ->getResultArray();

        $data = ['titulo' => 'Dispositvos de monitoreo', 'datos' => $resultado];

        echo view('header');
        echo view('monitoreo/observar', $data);
        echo view('footer');

    }

    public function sensor($sensorid){
        if(!isset($this->sesion->user_usuario)){return redirect()->to(base_url());}

        $db = \Config\Database::connect();
        $sql = $db ->table('info_sensores');
        $sql->select('*');
        $sql->where('info_sensores.ard_id', $sensorid);
        $query = $sql ->get();
        $resultado = $query ->getResultArray();

        $data = ['titulo' => 'Datos de los sensores', 'datos' => $resultado];

        echo view('header');
        echo view('monitoreo/sensor', $data);
        echo view('footer');

    }

  
}