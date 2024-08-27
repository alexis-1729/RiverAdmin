<?php

namespace App\Controllers;

class Home extends BaseController
{
    protected $sesion;
    public function __construct()
    {
        $this->sesion = session();
    }


    public function index(): string
    {
        if(!isset($this->sesion->user_usuario)){return redirect()->to(base_url());}
        return view('header')
        . view('tables')
        . view('footer');
    }
}
