<?php

require 'vendor/autoload.php';

$app = new \Slim\Slim(array(
    'view' => new \Slim\Extras\Views\Twig()
));
$twig = $app->view()->getEnvironment();
$twig->twigDirectory = './vendor/twig/twig/lib/Twig';
$twig->twigTemplateDirs = array('./templates');

$app->get('/', function () use ($app) {
    $app->render('index.twig');
});

$app->run();

?>