<?php

$title = "Edit Posts";

$level = '../';
include '../shared/header.php';

$Auth->requireUser();

$db = Database::getDatabase();
$result = $db->getRows("SELECT * FROM posts WHERE 1=1 ORDER BY date DESC");

//need to style out list summary with link to add-post.php?id=[postID]
?>
