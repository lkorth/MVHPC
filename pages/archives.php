<?php

$app->get('/archives', function () use ($app) {
    $app->render('archives.twig', array('page' => 'archives'));
});

$app->get('/archives/images(/:terms)', function ($terms = null) use ($app) {
    $arr = array();
    $arr['page'] = 'archives';
    $arr['terms'] = $terms;




    $app->render('archives.images.twig', $arr);
});

