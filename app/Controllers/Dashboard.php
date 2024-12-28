<?php

namespace App\Controllers;

use App\Controllers\Dispositivos;
use App\Models\RegistroModel;
use App\Models\RiosModel;

class Dashboard extends BaseController
{
    protected $sesion;
    protected $dispositivos;
    protected $users;
    protected $rios;
    public function __construct()
    {

        $this->sesion = session();
        $this-> dispositivos = new Dispositivos();
        $this -> users = new RegistroModel();
        $this -> rios = new RiosModel();
    }


    public function index(): string
    {
        if(!isset($this->sesion->user_usuario)){return redirect()->to(base_url());}
        
        $datos = $this -> users 
        -> select('pmonitoreo.monitoreo_nombre,
        info_user.user_nombre,info_user.user_apellido,river_ubi.ubi_municipio')
        ->join('pmonitoreo', 'pmonitoreo.monitoreo_id = info_user.user_rioid')
        ->join('river_ubi', 'river_ubi.ubi_id = pmonitoreo.riverubi_id')
        -> where('cuenta_id', 1) 
        -> findAll();
        
        $data = ['dat' => $datos];

        return  view('header')
        . view('tables', $data)
        . view('footer');
    }
}
