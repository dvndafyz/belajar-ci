<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Home::index', ['filter' => 'auth']);

$routes->get('login', 'AuthController::login');
$routes->post('login', 'AuthController::login');
$routes->get('logout', 'AuthController::logout');

$routes->group('produk', ['filter' => 'auth'], function ($routes) { 
    $routes->get('', 'ProdukController::index');
    $routes->post('', 'ProdukController::create');
    $routes->post('edit/(:any)', 'ProdukController::edit/$1');
    $routes->get('delete/(:any)', 'ProdukController::delete/$1');
    $routes->get('download', 'ProdukController::download');
});

$routes->group('keranjang', ['filter' => 'auth'], function ($routes) {
    $routes->get('', 'TransaksiController::index');
    $routes->post('', 'TransaksiController::cart_add');
    $routes->post('edit', 'TransaksiController::cart_edit');
    $routes->get('delete/(:any)', 'TransaksiController::cart_delete/$1');
    $routes->get('clear', 'TransaksiController::cart_clear');
});

$routes->group('ProdukCategory', ['filter' => 'auth'], function ($routes) { 
    $routes->get('', 'ProdukCategoryController::index');
    $routes->post('', 'ProdukCategoryController::create');
    $routes->post('edit/(:any)', 'ProdukCategoryController::edit/$1');
    $routes->get('delete/(:any)', 'ProdukCategoryController::delete/$1');
});

$routes->get('checkout', 'TransaksiController::checkout', ['filter' => 'auth']);
$routes->post('buy', 'TransaksiController::buy', ['filter' => 'auth']);

$routes->get('get-location', 'TransaksiController::getLocation', ['filter' => 'auth']);
$routes->get('get-cost', 'TransaksiController::getCost', ['filter' => 'auth']);

$routes->get('profile', 'Home::profile', ['filter' => 'auth']);

$routes->get('keranjang', 'TransaksiController::index', ['filter' => 'auth']);

$routes->get('contact', 'ContactController::index', ['filter' => 'auth']);

$routes->resource('api', ['controller' => 'apiController']);

$routes->get('/diskon', 'DiskonController::index');
$routes->get('diskon/create', 'DiskonController::create');
$routes->post('diskon/store', 'DiskonController::store');
$routes->get('/diskon/edit/(:num)', 'DiskonController::edit/$1');
$routes->post('/diskon/update/(:num)', 'DiskonController::update/$1');
$routes->get('/diskon/delete/(:num)', 'DiskonController::delete/$1');

$routes->get('transaksi/cart_delete/(:any)', 'TransaksiController::cart_delete/$1');
$routes->get('keranjang/add/(:num)', 'TransaksiController::addToCart/$1');


