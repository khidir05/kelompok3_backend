<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->group('api', ['namespace' => 'App\Controllers'], function($routes) {
    $routes->resource('pengajuan');
    $routes->resource('persetujuan');
    
    // Custom route untuk upload dokumen
    $routes->post('pengajuan/upload', 'Pengajuan::uploadDokumen');
});