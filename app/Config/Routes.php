<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/drilldowns/production-amount', 'DrilldownController::drilldownProductionAmount');
$routes->get('/drilldowns/production-value', 'DrilldownController::drilldownProductionValue');
$routes->get('/what-if', 'WhatIfController::index');
