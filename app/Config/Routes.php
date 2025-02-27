<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->post('login', 'Login::index');
$routes->post('login', 'AuthController::login');
$routes->post('mahasiswa/submit', 'Mahasiswa::submitApplication');
$routes->get('mahasiswa/applications/(:num)', 'Mahasiswa::getApplications/$1');
$routes->post('staff/approve/(:num)', 'Staff::approveApplication/$1');
$routes->get('staff/greetings/(:segment)', 'StaffController::greetings/$1');
$routes->get('staff/leave-applications', 'StaffController::viewAllLeaveApplications');
$routes->post('staff/decline/(:num)', 'Staff::declineApplication/$1');
$routes->get('staff/pending', 'Staff::getPendingApplications');
// Add routes for managing mahasiswa and staff, and processing leave applications