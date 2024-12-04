<?php

namespace Config;

use CodeIgniter\Router\RouteCollection;

$routes = Services::routes();   
/**
 * @var RouteCollection $routes
 */

 $routes -> setDefaultNamespace('App\Controllers');
 $routes -> setDefaultController('Registro');
 $routes -> setDefaultMethod('index');
 $routes -> setTranslateURIDashes(false);
 $routes -> set404Override();

$routes -> get('/', 'Home::index'); 
$routes->get('/RiverAdmin', 'Registro::login');
$routes -> setAutoRoute(true);

 
 //$routes->get('registro/usersAdmin.php','UsersT::index');
//  $routes->get('/dispositivosR.php','Dispositivos::index');
//  $routes->get('/rios.php','Rios::index');