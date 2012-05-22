<!DOCTYPE HTML>
<html>
<head>
  <?php
    // if browser is IE or Opera, unsupported for pdf.js
    $supported = true;
    if(strpos($_SERVER['HTTP_USER_AGENT'], "MSIE") !== false)
      $supported = false;
    else if(strpos($_SERVER['HTTP_USER_AGENT'], "Opera") !== false)
      $supported = false;

    // if set as a URL var, load a PDF's URL
    $viewing = isset($_GET["pdf"]);
    if($viewing){
  ?>
      <script type="text/javascript">
        // grab the specified PDF to display
        var pdfFile = "<?php echo $_GET['pdf'] ?>";
      </script>
    
  <?php
    }
    // if supported & viewing, load pdf.js
    $viewPDFjs = $supported && $viewing;
    if($viewPDFjs){
  ?>
      <script type="text/javascript" src="../js/pdf-js/pdf.js"> </script>

  <?php
    }
    // if unsupported & viewing, set to embed Google Docs Viewer
    $viewPDFdocs = !$supported && $viewing;
  ?>
</head>

<body>
  <div id="pdf-list">
    <?php
      // get & print out all PDF files in data folder
      $dir = "../data/";
      $loc = basename($_SERVER['SCRIPT_NAME']);
      $dirHandle = opendir($dir);
      while(($file = readdir($dirHandle)) !== false)
        if(eregi("\.pdf", $file)){
          $fileName = basename($file, ".pdf");
          $name = str_replace("_", " ", $fileName);
          $name = str_replace("-", " ", $name);
          echo "<div class='pdf-item'>";
            echo "<a href='$loc?pdf=$fileName'> $name </a>";
            echo "<span class='pdf-item-dl'>";
              echo "<a href='$dir$fileName.pdf'> (download PDF) </a>";
          echo "</span> </div>";
        }
      closedir($handle);
    ?>
  </div>

  <?php
    if($viewPDFjs){
  ?>
      <div id="pdf-viewer">
        <div id="pdf-toolbar">
          <button id="pdf-prev" onclick="goPrevious()"> Previous </button>
          <button id="pdf-next" onclick="goNext()"> Next </button>
          <label id="pdf-page-num-label" for="pdf-page-num"> Page: </label>
          <input id="pdf-page-num" onchange="goToPage(this.value);" type="number" value="1" size="4" min="1"> </input>
          / <span id="pdf-page-count"> </span>
          <button id="pdf-download" onclick="download();">
            <span> Download </span>
          </button>
          <button id="pdf-fullscreen" onclick="fullscreen();">
            <span> Fullscreen </span>
          </button>
        </div>
        
        <canvas id="pdf"> </canvas>
      
      </div>
      
      <script type="text/javascript" src="../js/pdf-js/pdf-viewer.js"> </script>
      
  <?php
    // if unsupported browser viewing a PDF, embed wtih Google Docs
    }else if($viewPDFdocs){
      // get the current location as a URL
      $path = dirname($_SERVER['REQUEST_URI']);
      $host = $_SERVER['SERVER_NAME'];
      
      // assemble this to a URL for the PDF
      $pdfURL = "http://" . $host . $path;
      $pdfURL .= '/data/' . $fileName . '.pdf';
      
      // TESTING ONLY - remove for production!!!!!
      $pdfURL = "http://www.education.gov.yk.ca/pdf/pdf-test.pdf";
      
      // create URL to Google Docs Viewer & embed on page
      $docsViewer = "http://docs.google.com/viewer?url=$pdfURL";
  ?>
      <iframe src="<?php echo $docsViewer ?>&embedded=true" width="600" height="780"> </iframe>
  <?php
    }
  ?>
  
</body>
</html>
