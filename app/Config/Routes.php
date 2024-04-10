<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('all_post', 'Home::post');
$routes->get('all_post/(:segment)', 'Home::openPost/$1');
$routes->get('projects', 'Home::projects');
$routes->get('projects/(:segment)', 'Home::openProject/$1');
$routes->get('messages', 'Home::messages');



$routes->post('save_post', 'Home::save_post');
$routes->post('upload_image', 'Home::upload_image');
$routes->post('delete_post', 'Home::delete_post');
$routes->post('save_project', 'Home::save_project');
$routes->post('send_message', 'Home::send_message');
$routes->post('open_message', 'Home::open_message');
$routes->post('send_mail', 'Home::send_mail');

$routes->get('admin', 'Admin::index');
$routes->get('login', 'Admin::loginPage');
$routes->get('register', 'Admin::registerPage');
$routes->post('loginUser', 'Admin::login');
$routes->post('registerUser', 'Admin::register');
