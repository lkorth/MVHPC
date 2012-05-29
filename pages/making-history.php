<?php

// set up template title & style
$template->setTitle('MVHPC :: Making History');
$template->setStyle('oneColumn');

// display the page
ob_start();
  ?>
<h1 class="ribbon"> History & Mount Vernon H.S. </h1>

<p class="body_text">
  The Commission works closely with the Mount Vernon High School to educate students on the value of historic preservation.
</p>

  <?php
$content = ob_get_clean();

// send content to template
$template->setSingleCol($content);

?>
