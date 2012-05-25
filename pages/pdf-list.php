<div id="pdf-list">

  <?php
    // folder containing PDFs
    $pdfFullURL = $_SERVER['DOCUMENT_ROOT'] . $pdfDirURL;

    // open PDF folder, look for PDFs
    $dirHandle = opendir($pdfFullURL);
    while (($file = readdir($dirHandle)) !== false) {
      if (preg_match('/\.pdf/i', $file)) {

        // get its filename (no extension)
        $fileName = basename($file, '.pdf');
        
        // prettify the filename
        $name = str_replace('_', ' ', $fileName);
        $name = str_replace('-', ' ', $name);

        // generate the PDF list with load and download links
        echo "<div class='pdf-item'>";
          echo '<a href="' . WEB_ROOT . $pageRoot . $fileName . '/">' . $name . '</a>';
          echo "<span class='pdf-item-dl'>";
              echo '<a href="' . $pdfDirURL . $fileName . '.pdf"> (download) </a>';
        echo '</span> </div>';
      }
    }
    
    // close the folder
    closedir($dirHandle);
    
  ?>
  
</div>
