<?php

/* from page-controller
    else if ($page == 'archives') {
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
        }} else if ($subpage == 'images') {
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
 */
?>
