<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/data', 'DataController::index');
$routes->get('/drilldowns/production-amount', 'DrilldownController::drilldownProductionAmount');
$routes->get('/drilldowns/production-value', 'DrilldownController::drilldownProductionValue');
$routes->get('/what-if', 'WhatIfController::index');
$routes->get('/what-if/data/(:num)', 'ProductionController::getDataByYear/$1');

$routes->get('what-if/analysis/(:num)/(:any)/(:num)', 'WhatIfController::calculateAnalysis/$1/$2/$3');
