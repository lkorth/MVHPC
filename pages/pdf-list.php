<div id="pdf-list">
  <?php
    // get & print out all PDF files in data folder
    $dir = "../$pdfDir";
    $dirHandle = opendir($dir);
    while (($file = readdir($dirHandle)) !== false) {
      if (preg_match('/\.pdf/i', $file)) {
        $fileName = basename($file, '.pdf');
        $name = str_replace('_', ' ', $fileName);
        $name = str_replace('-', ' ', $name);
        echo "<div class='pdf-item'>";
          echo "<a href='$pdfLoadURL$fileName/'> $name </a>";
          echo "<span class='pdf-item-dl'>";
              echo "<a href='$pdfLinkURL$pdfDir$fileName.pdf'> (download PDF) </a>";
        echo "</span> </div>";
      }
    }
    closedir($dirHandle);
  ?>
</div>
