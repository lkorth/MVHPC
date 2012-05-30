<?php

// set up template title & style
$template->setTitle('MVHPC :: Ash Park');
$template->setStyle('twoColumn');

// display the intro content in right pane
ob_start();
  ?>
<h1 class="ribbon"> Ash Park </h1>

<p class="body_text">
  The Ash Park National Historic District was established mainly in 1880 - 1910. This was during the Railroad Era when many fine residential homes sprung up in the north-western region of Mount Vernon.
</p>

<strong class="body_text"> Resources </strong>
<ul class="body_text">
  <li> View <a href="<?php WEBROOT(); ?>archives/images/ash%20park"> Archival Images </a></li>

</ul>

  <?php 

// send right pane output to template
$rightCol = ob_get_clean();
$template->setRightCol($rightCol);

?>
