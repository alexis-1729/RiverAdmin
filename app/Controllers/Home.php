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
        return view('header-h')
        .view('home-h')
        .view('footer-h');
    }
}
