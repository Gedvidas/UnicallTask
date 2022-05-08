<?php
require $_SERVER['DOCUMENT_ROOT'] . '/config/config.php';
require $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';
use Unicall\Application;
use Unicall\Http\Controller\EmailController;

$app = new Application();
$app->router->get('/', [EmailController::class, 'index'] );
$app->router->post('/post', [EmailController::class, 'post'] );

$app->run();
