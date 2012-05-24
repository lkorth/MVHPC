<?php
  include '../includes/master.inc.php';
?>

<!DOCTYPE html>
<html dir="ltr">
<head>
  <meta charset="utf-8">
  <title>PDF Viewer</title>
  <!-- PDFJSSCRIPT_INCLUDE_FIREFOX_EXTENSION -->
  <script type="text/javascript">
    var pdfFile = "<?php echo $_GET['pdf']; ?>";
    var webRoot = "<?php echo WEB_ROOT; ?>";
    var pdfURL = webRoot + "data/" + "<?php echo $_GET['dir']; ?>" + "/" + pdfFile + ".pdf";
  </script>
  <link rel="stylesheet" href="<?php echo WEB_ROOT; ?>css/pdf-viewer.css"/>

  <script type="text/javascript" src="<?php echo WEB_ROOT; ?>js/pdf-js/compatibility.js"></script>
  <!-- PDFJSSCRIPT_REMOVE_FIREFOX_EXTENSION -->

  <!-- This snippet is used in production, see Makefile -->
  <link rel="resource" type="application/l10n" href="<?php echo WEB_ROOT; ?>js/pdf-js/locale.properties"/>
  <script type="text/javascript" src="<?php echo WEB_ROOT; ?>js/pdf-js/l10n.js"></script>
  <script type="text/javascript" src="<?php echo WEB_ROOT; ?>js/pdf-js/pdf.js"></script>
  <script type="text/javascript">
    // This specifies the location of the pdf.js file.
    PDFJS.workerSrc = "<?php echo WEB_ROOT; ?>js/pdf-js/pdf.js";
  </script>
  <script type="text/javascript" src="<?php echo WEB_ROOT; ?>js/pdf-js/debugger.js"></script>
  <script type="text/javascript" src="<?php echo WEB_ROOT; ?>js/pdf-js/pdf-viewer-fs.js"></script>
</head>

<body>
  <div id="outerContainer">
    
    <div id="sidebarContainer">
      <div id="toolbarSidebar">
        <div class="splitToolbarButton toggled">
          <button id="viewThumbnail" class="toolbarButton toggled" title="Show Thumbnails" onclick="PDFView.switchSidebarView('thumbs')" tabindex="1" data-l10n-id="thumbs">
            <span data-l10n-id="thumbs_label"> Thumbnails </span>
          </button>
          <button id="viewOutline" class="toolbarButton" title="Show Document Outline" onclick="PDFView.switchSidebarView('outline')" tabindex="2" data-l10n-id="outline">
            <span data-l10n-id="outline_label"> Document Outline </span>
          </button>
        </div>
      </div>
      
      <div id="sidebarContent">
        <div id="thumbnailView"> </div>
        <div id="outlineView" class="hidden"> </div>
      </div>
    </div>  <!-- sidebarContainer -->
    
    <div id="mainContainer">
      <div class="toolbar">
        <div id="toolbarContainer">
          
          <div id="toolbarViewer">
            <div id="toolbarViewerLeft">
              <button id="sidebarToggle" class="toolbarButton" title="Toggle Sidebar" tabindex="3" data-l10n-id="toggle_slider">
                <span data-l10n-id="toggle_slider_label"> Toggle Sidebar </span>
              </button>
              <div class="toolbarButtonSpacer"> </div>
              <div class="splitToolbarButton">
                <button class="toolbarButton pageUp" title="Previous Page" onclick="PDFView.page--" id="previous" tabindex="4" data-l10n-id="previous">
                  <span data-l10n-id="previous_label"> Previous </span>
                </button>
                <div class="splitToolbarButtonSeparator"> </div>
                <button class="toolbarButton pageDown" title="Next Page" onclick="PDFView.page++" id="next" tabindex="5" data-l10n-id="next">
                  <span data-l10n-id="next_label"> Next </span>
                </button>
              </div>
              <label id="pageNumberLabel" class="toolbarLabel" for="pageNumber" data-l10n-id="page_label"> Page: </label>
              <input type="number" id="pageNumber" class="toolbarField pageNumber" onchange="PDFView.page = this.value;" value="1" size="4" min="1" tabindex="6">
              </input>
              <span id="numPages" class="toolbarLabel"> </span>
            </div>
            
            <div id="toolbarViewerRight">
              <button id="download" class="toolbarButton download" title="Download" onclick="PDFView.download();" tabindex="12" data-l10n-id="download">
                <span data-l10n-id="download_label"> Download </span>
              </button>
            </div>

            <div class="outerCenter">
              <div class="innerCenter" id="toolbarViewerMiddle">
                <div class="splitToolbarButton">
                  <button class="toolbarButton zoomOut" title="Zoom Out" onclick="PDFView.zoomOut();" tabindex="7" data-l10n-id="zoom_out">
                    <span data-l10n-id="zoom_out_label"> Zoom Out </span>
                  </button>
                  <div class="splitToolbarButtonSeparator"></div>
                  <button class="toolbarButton zoomIn" title="Zoom In" onclick="PDFView.zoomIn();" tabindex="8" data-l10n-id="zoom_in">
                    <span data-l10n-id="zoom_in_label"> Zoom In </span>
                  </button>
                </div>
                <span id="scaleSelectContainer" class="dropdownToolbarButton">
                  <select id="scaleSelect" onchange="PDFView.parseScale(this.value);" title="Zoom" oncontextmenu="return false;" tabindex="9" data-l10n-id="zoom">
                  <option id="pageAutoOption" value="auto" selected="selected" data-l10n-id="page_scale_auto"> Automatic Zoom </option>
                  <option id="pageActualOption" value="page-actual" data-l10n-id="page_scale_actual"> Actual Size </option>
                  <option id="pageFitOption" value="page-fit" data-l10n-id="page_scale_fit"> Fit Page </option>
                  <option id="pageWidthOption" value="page-width" data-l10n-id="page_scale_width"> Full Width </option>
                  <option id="customScaleOption" value="custom"> </option>
                  <option value="0.5"> 50% </option>
                  <option value="0.75"> 75% </option>
                  <option value="1"> 100% </option>
                  <option value="1.25"> 125% </option>
                  <option value="1.5"> 150% </option>
                  <option value="2"> 200% </option>
                </select>
                </span>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <div id="viewerContainer">
        <div id="viewer"> </div>
      </div>
      
      <div id="loadingBox">
        <div id="loading" data-l10n-id="loading" data-l10n-args='{"percent": 0}'>Loading... 0%</div>
          <div id="loadingBar"> <div class="progress"> </div> </div>
        </div>
        
        <div id="errorWrapper" hidden='true'>
          <div id="errorMessageLeft">
            <span id="errorMessage"></span>
            <button id="errorShowMore" onclick="" oncontextmenu="return false;" data-l10n-id="error_more_info">
              More Information
            </button>
            <button id="errorShowLess" onclick="" oncontextmenu="return false;" data-l10n-id="error_less_info" hidden='true'>
              Less Information
            </button>
          </div>
          <div id="errorMessageRight">
            <button id="errorClose" oncontextmenu="return false;" data-l10n-id="error_close">
              Close
            </button>
          </div>
          <div class="clearBoth"> </div>
          <textarea id="errorMoreInfo" hidden='true' readonly="readonly"> </textarea>
        </div>
      </div> <!-- mainContainer -->
    </div> <!-- outerContainer -->
  </body>
</html>
