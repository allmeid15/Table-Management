<?php

/**
 * Routing
 */
$router = new Core\Router();

// Add the routes
$router->add('dashboard', ['controller' => 'Home', 'action' => 'index']);

$router->add('users', ['controller' => 'UserController', 'action'=> 'index']);
$router->add('users/store', ['controller'=>'UserController', 'action' => 'store']);
$router->add('users/create', ['controller'=>'UserController', 'action' =>'create']);
$router->add('users/edit', ['controller'=>'UserController', 'action' =>'edit']);
$router->add('users/update', ['controller'=>'UserController', 'action' =>'update']);
$router->add('users/delete', ['controller'=>'UserController', 'action' =>'destroy']);


$router->add('roles', ['controller' => 'RoleController', 'action' =>'index']);
$router->add('roles/store', ['controller' => 'RoleController', 'action' => 'store']);
$router->add('roles/create', ['controller' => 'RoleController', 'action' => 'create']);


$router->add('tables', ['controller' => 'TableController', 'action' => 'index']);
$router->add('tables/store', ['controller' => 'TableController', 'action' =>'store']);
$router->add('tables/create', ['controller' => 'TableController', 'action' => 'create']);
$router->add('tables/edit', ['controller'=>'TableController', 'action' =>'edit']);
$router->add('set-table-session', ['controller'=>'TableController', 'action' =>'setTableSession', 'method' => 'POST']);


$router->add('orders', ['controller' => 'OrderController', 'action'=> 'index']);
$router->add('orders/store', ['controller'=> 'OrderController', 'action'=> 'store']);
$router->add('orders/create', ['controller'=>'OrderController', 'action'=>'createOrContinueOrder']);
$router->add('orders/submit', ['controller' => 'OrderController', 'action' => 'submit', 'method' => 'POST']);
$router->add('orders/save', ['controller' => 'OrderController', 'action' => 'save', 'method' => 'POST']);
//$router->add('orders/get-open-order', ['controller'=>'OrderController', 'action'=>'getOpenOrder']);
$router->add('orders/get-open/order', ['controller'=>'OrderController', 'action'=>'getOpenOrder']);


$router->add('products', ['controller' => 'ProductController', 'action'=>'index']);
$router->add('products/store', ['controller' => 'ProductController', 'action'=>'store']);
$router->add('products/create', ['controller' => 'ProductController', 'action'=>'create']);
$router->add('products/edit', ['controller' => 'ProductController', 'action'=>'edit']);
$router->add('products/update', ['controller' => 'ProductController', 'action'=>'update']);
$router->add('products/delete', ['controller' => 'ProductController', 'action'=>'destroy']);


$router->add('categories', ['controller'=>'CategoryController', 'action'=>'index']);
$router->add('categories/store', ['controller'=>'CategoryController', 'action'=>'store']);
$router->add('categories/create', ['controller'=>'CategoryController', 'action'=>'create']);
$router->add('categories/edit', ['controller'=>'CategoryController', 'action'=>'edit']);
$router->add('categories/update', ['controller'=>'CategoryController', 'action'=>'update']);
$router->add('categories/delete', ['controller'=>'CategoryController', 'action'=>'destroy']);


$router->add('invoices', ['controller'=>'InvoiceController', 'action'=> 'index']);



$router->add('login', ['controller' => 'AuthController', 'action' => 'login']);
$router->add('login/store', ['controller' => 'AuthController', 'action' => 'loginStore']);
$router->add('logout', ['controller' => 'AuthController', 'action' => 'logout']);


$router->dispatch($_SERVER['QUERY_STRING']);


?>