<?php

// allow for code to be inserted into the header
// custom HTML, javascript, CSS (in this order)
// custom HTML is written as an object buffer
// javascript and CSS should insert files with array_push
$headerCustom = NULL;
$headerCSS = array();
$headerJS = array();

if ($page == 'archives') {
    if($subpage == 'images'){
      $fullsize = ($subpage2 != NULL && is_numeric($subpage2[0]) && returnImage($subpage2) != NULL);
      if (!$fullsize) {
        include 'images.php';
      }
      else{
        include 'images-full.php';
      }
    } else if($subpage == 'secondary-documents'){
        if ($subpage2 != 'Centennial-Book-Index') {
          include 'secondary-documents.php';
        }
        else {
          include 'centennial-book-index.php';
        }
    } else if($subpage == 'cemetery') {
        include 'cemetery.php';
    } else {
        include 'archives.php';
    }
} else if($page == 'map'){
    if ($subpage == 'ash-park'){
        include 'map-ash-park.php';
    } else if ($subpage == 'commercial'){
        include 'map-commercial.php';
    } else if ($subpage == 'cornell-college'){
        include 'map-cornell-college.php';
    } else {
        include 'map.php';
    }
    include 'map-display.php';
} else if($page == 'making-history'){
    include 'making-history.php';
} else if($page == 'about'){
    if($subpage == 'design-review'){
        include 'design-review.php';
    } else if($subpage == 'links'){
    } else {
        include 'about.php';
    }
} else if ($page == 'request-tag-change') {
    include 'request-tag-change.php';
}

// package up header items and send to template
$headerExtras = array(
  'custom' => $headerCustom,
  'css' => $headerCSS,
  'js' => $headerJS,
);
$template->setHeaderExtras($headerExtras);

