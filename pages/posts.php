<?php

$level = '../';
include '../shared/header.php';

if(!isset($_GET['id']) || empty($_GET['id']))
    redirect('../error/404.php');

$post = getAPost($_GET['id']);

print_r($post);

include '../shared/footer.php';
?>
