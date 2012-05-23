<?php
$title = "Add Posts";

$level = '../';
include '../shared/header.php';

$Auth->requireUser();

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $db = Database::getDatabase();
    $result = $db->getRow("SELECT * FROM posts WHERE id = '$id'");
}

//need to have form with title, text and page fields, hidden id field. Populate fields if isset($result) === true
?>
