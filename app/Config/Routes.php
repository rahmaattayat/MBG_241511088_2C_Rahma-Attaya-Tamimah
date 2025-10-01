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
$routes->post('/dashboard/simpan-bahan-baku', 'Dashboard::simpanBahanBaku', ['filter' => 'auth']);
