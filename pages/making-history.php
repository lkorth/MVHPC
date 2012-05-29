<?php

// set up template title & style
$template->setTitle('MVHPC :: Making History');
$template->setStyle('oneColumn');

// display the page with intro and Google Map
ob_start();
  ?>
<h1 class="ribbon"> Making History with Mount Vernon High School </h1>

<p class="body_text">
  The Commission works closely with the Mount Vernon High School to educate students on the value of historic preservation, specificially for the Mount Vernon community
</p>

  <?php
$content = ob_get_clean();

// send content to template
$template->setSingleCol($content);

?>
