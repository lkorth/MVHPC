<?php

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

class CustomApplication extends Application {
    use Silex\Application\TwigTrait;
}

$app = new CustomApplication();
$app['debug'] = true;
if($app['debug']) {
    $app->register(new Whoops\Provider\Silex\WhoopsServiceProvider);
}
$app->register(new Silex\Provider\SessionServiceProvider());
$app->register(new Silex\Provider\ServiceControllerServiceProvider());
$app->register(new Silex\Provider\UrlGeneratorServiceProvider());
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => 'views',
    'twig.options' => array(
        'charset' => 'utf-8',
        'cache' => 'cache'
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
    'profiler.cache_dir' => 'cache/profiler',
));
$app->mount('/_profiler', $p);

$app->register(new Silex\Provider\HttpCacheServiceProvider(), array(
    'http_cache.cache_dir' => 'cache',
    'http_cache.esi'       => null,
));

$app->error(function (\Exception $e, $code) use ($app) {
    if ($app['debug'])
        return;

    $arr = array();
    $arr['page'] = 'error';
    $arr['code'] = $code;
    switch ($code) {
        case 403:
            $arr['message'] = 'Sorry, you do not have access to this page.';
            break;
        case 404:
            $arr['message'] = 'Sorry, the page you are looking for could not be found.';
            break;
        default:
            $arr['message'] = 'Sorry, but something went terribly wrong.';
            break;
    }

    return new Response($app['twig']->render('error.twig', $arr));
});
$app->get('/', 'MVHPC\Home::index');
$app->get('/archives', 'MVHPC\Archives::index');
$app->get('/archives/secondary-documents', 'MVHPC\Archives::secondaryDocuments');
$app->get('/archives/images/{terms}/{page}', 'MVHPC\Archives::images')
    ->value('terms', null)
    ->value('page', 0);
$app->get('/about', 'MVHPC\About::index');

$app->get('/making-history', 'MVHPC\History::makingHistory');

/*
require('error/error.php');
require('ajax/ajax.php');
require('backend/backend.php');

require('pages/history.php');
*/

$app['http_cache']->run();