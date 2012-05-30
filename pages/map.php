<?php

// set up template title & style
$template->setTitle('MVHPC :: Map');
$template->setStyle('twoColumn');

// display the intro content in right pane
ob_start();
  ?>
<h1 class="ribbon"> Districts </h1>

<p class="body_text">
  The primary responsibility of the Commission is to designate Historic Districts. Mt. Vernon has three National Historic Districts:
</p>

<ul class="body_text">
  <li><a href="ash-park/"> Ash Park </a></li>
  <li><a href="commercial/"> Commercial </a></li>
  <li><a href="cornell-college/"> Cornell College </a></li>
</ul>

  <?php 

// send right pane output to template
$rightCol = ob_get_clean();
$template->setRightCol($rightCol);

?>
