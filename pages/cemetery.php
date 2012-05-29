<?php

// set up template title & style
$template->setTitle('MVHPC :: Cemetery Plots');
$template->setStyle('oneColumn');

// display the page
ob_start();
  ?>
<h1 class="ribbon"> Cemetery Plots </h1>

<p class="body_text">
  Search through the cemetery records to find plot numbers.
</p>
<p class="body_text">
  For further information such as detailed location on a map, please <a href="contact-form.php"> contact us </a>. 
</p>

  <?php
$content = ob_get_clean();

// send content to template
$template->setSingleCol($content);

?>
