<?php

include('includes/master.inc.php');
require 'vendor/autoload.php';

//class R extends RedBean_Facade {}
//R::setup('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASSWORD);
//R::freeze();

$app = new \Slim\Slim(array(
    'view' => new \Slim\Extras\Views\Twig()
));
$twig = $app->view()->getEnvironment();
$twig->twigDirectory = './vendor/twig/twig/lib/Twig';
$twig->twigTemplateDirs = array('./templates');
$twig->addFilter('max_words', new Twig_Filter_Function('max_words'));

$js = array();
$js[] = 'jquery-172.js';
$js[] = 'heights.js';

$css = array();
$css[] = 'EngraversMT.css';
$css[] = 'Belleza.css';
$css[] = 'main.css';

$twig->addGlobal('css', $css);
//$twig->addGlobal('js', $js);
$twig->addGlobal('CACHE_BREAK_CSS', CACHE_BREAK_CSS);
$twig->addGlobal('CACHE_BREAK_JS', CACHE_BREAK_JS);

$app->get('/', function () use ($app) {
    global $js;

    $arr = array();
    $arr['page'] = 'home';
    $arr['images'] = featuredImages();
    $arr['post'] = returnPosts('index', 1);
    $arr['post'] = $arr['post'][0];
    array_push($js, 'image-script.js');
    $arr['js'] = $js;

    $app->render('index.twig', $arr);
});

$app->run();

?>