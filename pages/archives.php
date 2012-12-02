<?php

$app->get('/archives', function () use ($app) {
    $app->render('archives.twig', array('page' => 'archives'));
});






