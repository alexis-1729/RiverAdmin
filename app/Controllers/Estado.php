<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\EstadoModel;


class Estado extends BaseController
{

    protected $users;
    protected $sesion;
    public function __construct()
    {
        $this-> users = new EstadoModel();
        $this->sesion = session();
    }

    ///funcion para obtener de la base de datos los usarios activos
    public function index($active = 1)
    {
        if(!isset($this->sesion->user_usuario)){return redirect()->to(base_url());}

        $users = $this->users->where('active', $active)->findAll();
        $data =['titulo' => 'Estado', 'datos' => $users];

        echo view('header');
        echo view('estado/estado', $data);
        echo view('footer');
    }

    public function nuevo(){
        if(!isset($this->sesion->user_usuario)){return redirect()->to(base_url());}
        $data = ['titulo' => 'Agregar Estado'];
        echo view('header');
        echo view('estado/nuevo', $data);
        echo view('footer');
    }

    public function insertar(){
        $this-> users ->save(['estado_nombre' => $this->request->getPost('estado_nombre')]);
        return redirect()->to(base_url().'/estado');
    }

    public function editar($user_id){
        if(!isset($this->sesion->user_usuario)){return redirect()->to(base_url());}
        $user = $this->users->where('estado_id', $user_id)->first();
        $data = ['titulo' => 'Editar Estado', 'datos' => $user];

        echo view('header');
        echo view('estado/editar', $data);
        echo view('footer');
    }

    public function actualizar(){

        $this-> users ->update($this->request->getPost('estado_id'),['estado_nombre' => $this->request->getPost('estado_nombre')]);
        return redirect()->to(base_url().'/estado');
    }

    public function eliminar($id){
        $this->users->update($id, ['active'=> 0]);
        return redirect()->to(base_url().'/estado');
    }

    public function eliminados($active=0){
        if(!isset($this->sesion->user_usuario)){return redirect()->to(base_url());}
        $users = $this->users->where('active', $active)->findAll();
        $data =['titulo' => 'Estados Eliminados', 'datos' => $users];

        echo view('header');
        echo view('estado/eliminados', $data);
        echo view('footer');
    }

    public function restaurar($id){
        $this->users->update($id, ['active'=> 1]);
        return redirect()->to(base_url().'estado');

    }
}