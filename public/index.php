<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Maintenance mode ?
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Charge l’autoload de Composer
require __DIR__.'/../vendor/autoload.php';

// Initialise l'application Laravel
$app = require_once __DIR__.'/../bootstrap/app.php';

// Crée le kernel HTTP
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

// Capture la requête HTTP
$request = Request::capture();

// Gère la requête et envoie la réponse
$response = $kernel->handle($request);

$response->send();

$kernel->terminate($request, $response);
