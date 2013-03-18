<?php

session_cache_limiter('');

require_once('includes/master.inc.php');
require_once('vendor/autoload.php');

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$js = array();
$js[] = 'jquery-172.js';
$js[] = 'heights.js';

$css = array();
$css[] = 'EngraversMT.css';
$css[] = 'Belleza.css';
$css[] = 'main.css';

//class R extends RedBean_Facade {}
//R::setup('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASSWORD);
//R::freeze();

$app = new Application();
$app['debug'] = true;
$app->register(new Silex\Provider\ServiceControllerServiceProvider());
$app->register(new Silex\Provider\UrlGeneratorServiceProvider());
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__ . '/views',
    'twig.options' => array(
        'charset' => 'utf-8',
        'cache' => __DIR__ . '/cache'
    ),
));

$app['twig'] = $app->share($app->extend('twig', function($twig, $app) {
    global $css, $js;

    $twig->addFilter('max_words', new Twig_Filter_Function('max_words'));

    $twig->addGlobal('css', $css);
    $twig->addGlobal('js', $js);
    $twig->addGlobal('CACHE_BREAK_CSS', CACHE_BREAK_CSS);
    $twig->addGlobal('CACHE_BREAK_JS', CACHE_BREAK_JS);

    return $twig;
}));

$app->register(new \Devture\SilexProvider\PJAX\ServicesProvider());
$app->register($p = new \Silex\Provider\WebProfilerServiceProvider(), array(
    'profiler.cache_dir' => __DIR__ . '/cache/profiler',
));
$app->mount('/_profiler', $p);

$app->register(new Silex\Provider\HttpCacheServiceProvider(), array(
    'http_cache.cache_dir' => __DIR__ . '/cache/',
    'http_cache.esi'       => null,
));

$app->get('/', 'MVHPC\Home::index');
$app->get('/archives', 'MVHPC\Archives::index');
$app->get('/archives/secondary-documents', 'MVHPC\Archives::secondaryDocuments');
$app->get('/archives/images/{terms}/{page}', 'MVHPC\Archives::images')
    ->value('terms', null)
    ->value('page', 0);
$app->get('/about', 'MVHPC\About::index');

/*
require('error/error.php');
require('ajax/ajax.php');
require('backend/backend.php');

require('pages/history.php');
require('pages/makingHistory.php');
*/

$app['http_cache']->run();