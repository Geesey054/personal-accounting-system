<?php

use CodeIgniter\Router\RouteCollection;
use Config\Services;

/**
 * @var RouteCollection $routes
 */
$routes = Services::routes();

/*
 * -----------------------------
 * Router setup
 * -----------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false); // 🔒 MUHIIM

/*
 * -----------------------------
 * PUBLIC ROUTES (login la’aan)
 * -----------------------------
 */
$routes->get('/', 'Home::index');
$routes->get('login', 'Auth::login');
$routes->post('login', 'Auth::loginPost');
$routes->get('logout', 'Auth::logout');

/*
 * -----------------------------
 * PROTECTED ROUTES (LOGIN KALIYA)
 * -----------------------------
 */
$routes->group('', ['filter' => 'auth'], function ($routes) {

    // Dashboard
    $routes->get('dashboard', 'Dashboard::index');

    // Expense Accounting
    $routes->get('Expense-accounting', 'ExpenseAccounting::index');
    $routes->post('Expense-accounting', 'ExpenseAccounting::index');
    $routes->post('ExpenseAccounting/save', 'ExpenseAccounting::save');

      $routes->get('revenue', 'ExpenseAccounting::index');
      $routes->post('revenue', 'ExpenseAccounting::index');
      $routes->post('ExpenseAccounting/save', 'ExpenseAccounting::save');
      $routes->post('ExpenseAccounting/save', 'ExpenseAccounting::save');
     

      
      

    // Account Statement
    $routes->get('account-statement', 'AccountStatement::index');
    $routes->get('account-statement/(:num)', 'AccountStatement::index/$1');
    $routes->post('account-statement/ajax', 'AccountStatement::ajaxStatement');
});
