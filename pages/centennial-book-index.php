<?php

// set up template title & style
$template->setTitle('MVHPC :: Centennial Book Index');
$template->setStyle('oneColumn');

// check if we are viewing a letter or not
$viewingLetter = false;
if (isset($subpage3)) {
  $letter = $subpage3;
  $viewingLetter = true;
}

// display the content
ob_start();

// set header for page
  ?>
<h1 class="ribbon"> Centennial Book Index </h1>
<div id="book_index">
  <?php
// print out the index selection
$i = 0;
foreach (range('A', 'Z') as $l) {
  ?>

<a href="<?php WEBROOT(); ?>archives/documents/Centennial-Book-Index/<?php echo $l; ?>"> [<?php echo $l; ?>] </a> &nbsp;&nbsp;

  <?php
  
  if ($i == 15) {
    ?>

<br />

    <?php
  }
  
  $i++;
}
?>
</div>
<?php
// display index if viewing on a letter
if ($viewingLetter) {
  ?>

<ul class="body_text" id="index-terms">

  <?php
  // grab all indices for the page
  $indices = returnCentennialIndex($letter);

  // for each index, display it and its pages
  foreach ($indices as $index) {
    ?>

<li> <?php echo $index['index']; ?> :

    <?php

    // iterate through each page
    $pages = explode(',', $index['pages']);
    $i = 1;
    foreach ($pages as $page) {

      // print out each page as a link
      ?>

<a href="<?php WEBROOT(); ?>archives/documents/Centennial-Book/<?php echo $page; ?>"> <?php echo $page; ?></a> <?php if ($i < count($pages)) {echo ',  '; } ?>

      <?php
      $i++;
    }
    ?>

</li>

    <?php
  }

  // close the list
  ?>
</ul>
  <?php
}

// send content to template
$content = ob_get_clean();
$template->setSingleCol($content);

?>
