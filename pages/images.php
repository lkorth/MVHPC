<?php

$subpage2 = str_replace('$999', '%2F', $subpage2);
if(strstr($subpage2, '/')){
    $tmp = explode('/', $subpage2);
    $subpage2 = $tmp[0];
    $subpage3 = $tmp[1];
}

$paging = str_replace('%2F', '$999', $subpage2);

$terms = strtolower(urldecode($subpage2));
$page = (isset($subpage3) && !empty($subpage3)) ? $subpage3 : 1;

// change title if searching, and set the title
if (!empty($terms))
    $title = 'Search of ' . $terms;
$template->setTitle($title);

