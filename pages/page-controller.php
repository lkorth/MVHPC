<!doctype html>

<?php
// include the framework and templating
require_once '../includes/master.inc.php';
require_once '../includes/class.template.php';

// define a new template
$template = new Template();

// custom JS, CSS, etc. for any page (loaded first)
$headerCustom = NULL;

// default JS to load
$headerJS = array(
    0 => 'jquery-172.js',
    1 => 'functions.js',
    2 => 'base64.js'
);

// default CSS to load
$headerCSS = array();

// get current page
if (!isset($_GET['page'])) {
    redirect('../error/404.php');
}
$page = $_GET['page'];

// get the sub-page, if applicable
$subpage = NULL;
if (isset($_GET['subpage']) && !empty($_GET['subpage'])) {
    $subpage = $_GET['subpage'];
}

// get the sub-sub-page, if applicable
$subpage2 = NULL;
if (isset($_GET['subpage2']) && !empty($_GET['subpage2'])) {
    $subpage2 = $_GET['subpage2'];
}

// get the sub-sub-sub-page, if applicable
$subpage3 = NULL;
if (isset($_GET['subpage3']) && !empty($_GET['subpage3'])) {
    $subpage3 = $_GET['subpage3'];
}

// Define variables for each page, like title
// include ALL custom CSS, Javascript, etc.
// load custom page content with $id = 0, otherwise from DB
// for two-column page: $template -> setStyle('twoColumn');

$template->setStyle('oneColumn');

if ($page == 'map') {
    if ($subpage == NULL) {
        $title = 'MVHPC :: Map of Mount Vernon';
        ob_start();
        ?>
        <script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyCJFrrSGy6p-7k8An5kvqJVJpaGRjV2aV4&sensor=false"> </script>
        <?php
        $headerCustom = ob_get_clean();
        array_push($headerJS, 'map-labels.js', 'map-viewer.js');
    } else if ($subpage == 'ash-park-district') {
        
    } else if ($subpage == 'commercial-district') {
        
    } else if ($subpage == 'cornell-district') {
        
    } else {
        redirect('../error/404.php');
    }
} else if ($page == 'archives') {
    if ($subpage == NULL) {
        $title = 'MVHPC :: Archives';
        $page_id = $page;
    } else if ($subpage == 'documents') {
        // only for Centennial Book index
        if ($subpage2 == 'Centennial-Book-Index') {
            $title = 'MVHPC:: Centennial Book';
        }
        // otherwise, normal document display
        else {
            $title = 'MVHPC :: Documents';
            $pdfFile = $subpage2;
            array_push($headerCSS, 'pdf-viewer.css');
            include 'documents.php';
            if ($pdfViewing) {
                ob_start();
                jsVars();
                $headerCustom = ob_get_clean();
                if ($pdfSupported) {
                    array_push($headerJS, 'pdf-js/pdf-min.js', 'pdf-js/pdf-viewer.js');
                }
            }
        }
    } else if ($subpage == 'images') {
        $fullsize = ($subpage2 != NULL && is_numeric($subpage2[0]));
        if (!$fullsize) {
            $title = 'MVHPC :: Images';
            array_push($headerJS, 'jquery-bgiframe-min.js', 'jquery-ajaxQueue.js', 'jquery-autocomplete.js', 'inpage_script.js');
            array_push($headerCSS, 'jquery.autocomplete.css');
        } else {
            $title = 'MVHPC :: Images';
            array_push($headerJS, 'jquery-mousewheel.js', 'jquery-ui-1820-custom-min.js', 'jquery-gzoom.js'
            );
            array_push($headerCSS, 'jquery-ui-1820-custom.css', 'jquery-gzoom.css'
            );
        }
    } else {
        redirect('../error/404.php');
    }
} else if ($page == 'about') {
    if ($subpage == NULL) {
        $title = 'MVHPC :: About Us';
        $page_id = $page;
    } else if ($subpage == 'links') {
        $title = 'MVHPC :: Links';
        $page_id = $subpage;
    } else if ($subpage == 'design-review') {
        $title = 'MVHPC :: Design Review';
        $pdfFile = $subpage2;
        array_push($headerCSS, 'pdf-viewer.css');
        include 'design-review.php';
        if ($pdfViewing) {
            ob_start();
            jsVars();
            $headerCustom = ob_get_clean();
            if ($pdfSupported) {
                array_push($headerJS, 'pdf-js/pdf-min.js', 'pdf-js/pdf-viewer.js');
            }
        }
    } else {
        redirect('../error/404.php');
    }
} else {
    redirect('error/404.php');
}

// package up the custom code to the template
$headerExtras = array(
    'custom' => $headerCustom,
    'js' => $headerJS,
    'css' => $headerCSS,
);
$template->setHeaderExtras($headerExtras);

// set title for each page
if (isset($title)) {
    $template->setTitle($title);
}

// open PHP buffer, grab page content
// if $id exists, load page from database
if (isset($page_id)) {
    $db = Database::getDatabase();
    $rows = $db->getRows("SELECT * FROM pages WHERE page='{$page_id}'");

    if (count($rows) > 1) {
        foreach ($rows as $row) {
            $rows[$row['column']] = $row;
        }
        $leftCol = $rows['left']['text'];
        $rightCol = $rows['right']['text'];
        $template->setStyle('twoColumn');
    } else {
        $singleCol = $rows[0]['text'];
    }
}

// otherwise, load page from a file
else {
    ob_start();
    if ($page == 'map') {
        include 'map.php';
    } else if ($subpage == 'images') {
        if (!$fullsize) {
            $subpage3 = $_GET['subpage3'];
            include 'images.php';
        } else {
            include 'fullsize.php';
        }
    }
    // documents from the archives
    else if ($page == 'archives' && $subpage == 'documents') {
        // show the Centennial Book index instead
        if ($subpage2 == 'Centennial-Book-Index') {
            include 'bookindex.php';
        }
        // pdf viewer, display the page by passing in needed variables
        else {
            generatePage();
        }

        // pdf viewer, display the page by passing in needed variables
    } else if ($page == 'about' && $subpage == 'design-review') {
        generatePage();
    }

    // grab the content to display for a single column page
    $singleCol = ob_get_clean();
}



// send the body to the template to display
if ($template->getStyle() == 'oneColumn') {
    $template->setSingleCol($singleCol);
} else {
    $template->setLeftCol($leftCol);
    $template->setRightCol($rightCol);
}



// render the template
$template->output();
?>
