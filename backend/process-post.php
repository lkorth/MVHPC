<?php
require_once '../includes/master.inc.php';

$Auth->requireUser();

$title = $_POST['title'];
$text = $_POST['text'];
$page = $_POST['page'];

$db = Database::getDatabase();

if(isset($_POST['id'])){
    $id = $_POST['id'];
    $db->query("UPDATE posts SET title = :title:, text = :text:, page = :page: WHERE id = :id:", array('title' => $title, 'text' => $text, 'page' => $page, 'id' => $id));
}
else {
    $db->query("insert into posts set title = :title:, text = :text:, page = :page:", array('title' => $title, 'text' => $text, 'page' => $page));
}

header("Location: action.php?message=Post+was+successfully+saved");
?>