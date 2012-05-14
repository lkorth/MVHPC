<?php
//convert to framework for sendmail, store in db also
if($_POST['type']==0){
$email = $_POST['email'];
$message = $_POST['message'];
$id = $_POST['id'];
$message = $message . "\n" . "\n" . "\n" . "Click this link to update the tags:  "."http://www.mvhpc.org/change_tags.php?redirect=1&id=" . $id;

mail( "tags@mvhpc.org", "Change of Tags Requested:  Media ID: $id",
        $message, "From: $email" );
header( "Location: index.php" );
}
else if ($_POST['type']==1){
$email = $_POST['email'];
$to = $_POST['to'];
$domain = $_POST['domain'];
$subject = $_POST['subject'];
$message = $_POST['message'];
$page = $_POST['page'];

mail( $to . '@' . $domain, $subject,
        $message, "From: $email" );
$location = "Location: " + $page;
header($location);
}
?>