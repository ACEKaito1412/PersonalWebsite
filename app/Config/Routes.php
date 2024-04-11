<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('test', 'Home::test');


$routes->post('save_item', 'Home::save_item');
$routes->post('upload_image', 'Home::upload_image');
$routes->post('delete_item', 'Home::delete_item');


// Admin Controller
$routes->get('admin', 'Admin::index');
$routes->get('login', 'Admin::loginPage');
$routes->get('register', 'Admin::registerPage');
$routes->post('loginUser', 'Admin::login');
$routes->post('registerUser', 'Admin::register');

// Message Controller
$routes->get('messages', 'MessageController::index');
$routes->post('send_message', 'MessageController::send_message');
$routes->post('open_message', 'MessageController::open_message');
$routes->post('send_mail', 'MessageController::send_mail');


// Project Controller 
$routes->get('projects', 'ProjectController::index');
$routes->get('projects/(:segment)', 'ProjectController::openProject/$1');
$routes->post('save_project', 'ProjectController::save_project');


// Post Controller
$routes->get('all_post', 'PostController::index');
$routes->get('all_post/(:segment)', 'PostController::openPost/$1');
