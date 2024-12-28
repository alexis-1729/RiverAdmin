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

    public function blog(){
        return view('head')
        .view('riverPagina/blog')
        .view('footer-h');
    }

    public function contacto(){
        return view('head')
        .view('riverPagina/contacto')
        .view('footer-h');
    }

    public function donaciones(){
        return view('head')
        .view('riverPagina/donaciones')
        .view('footer-h');
    }

}
