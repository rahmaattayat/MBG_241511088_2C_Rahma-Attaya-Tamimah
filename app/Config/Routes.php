<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Login::index');
$routes->get('/login', 'Login::index');
$routes->post('/login/process', 'Login::process');
$routes->get('/logout', 'Login::logout');

$routes->get('/dashboard', 'Dashboard::index', ['filter' => 'auth']);
$routes->get('/dashboard/tambah-bahan-baku', 'Dashboard::tambahBahanBaku', ['filter' => 'auth']);
$routes->group('bahanbaku', ['filter' => 'auth'], function($routes){
    $routes->get('/', 'BahanBaku::index');
    $routes->get('create', 'BahanBaku::create'); 
    $routes->post('store', 'BahanBaku::store');  
    $routes->get('edit/(:num)', 'BahanBaku::edit/$1');    
    $routes->post('update/(:num)', 'BahanBaku::update/$1');
});
$routes->get('/bahanbaku', 'BahanBaku::index', ['filter' => 'auth']);