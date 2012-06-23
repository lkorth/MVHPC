<?php

class Template {

    private $DEFAULT_TITLE = "Mount Vernon Historic Preservation Commission";
    private $DEFAULT_BODY = "There was an error finding the content for this page. Please contact the system administrator for assistance.";
    private $DEFAULT_IMAGE = "http://www.mvhpc.org/images/MVHPC-Logo-Brown.png";
    private $DEFAULT_SUMMARY = "Welcome to the exciting past and present of an unusual small community in the heart of the Heartland! This site opens our historical resources to the Internet and invites you to share in adding information, correcting our sources, and asking us for specific information you cannot find here. This site is an organic history book ‚ it continues to grow from the input and knowledge of anyone in the world. Almost all of our known historical resources will eventually be available on this website.";
    private $style;
    private $title;
    private $image;
    private $summary;
    private $headerExtras;
    private $singleCol;
    private $leftCol;
    private $rightCol;
    private $currentPage;

    public function _construct() {
        $this->style = "oneColumn";
        $this->title = $this->DEFAULT_TITLE;
        $this->image = $this->DEFAULT_IMAGE;
        $this->summary = $this->DEFAULT_SUMMARY;
        $this->singleCol = $this->DEFAULT_BODY;
    }

    public function setStyle($style) {
        $this->style = $style;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function setImage($image) {
        $this->image = $image;
    }

    public function setSummary($summary) {
        $this->summary = $summary;
    }

    public function setHeaderExtras($extras) {
        $this->headerExtras = $extras;
    }

    public function setSingleCol($singleCol) {
        $this->singleCol = $singleCol;
    }

    public function setLeftCol($leftCol) {
        $this->leftCol = $leftCol;
    }

    public function setRightCol($rightCol) {
        $this->rightCol = $rightCol;
    }

    public function setCurrentPage($currentPage) {
        $this->currentPage = $currentPage;
    }

    public function getStyle() {
        return $this->style;
    }

    // display proper class for each menu item
    private function outputNavClass($page) {
        if ($page == $this->currentPage)
            return "menu_item_current";
        else
            return "menu_item";
    }

    public function output() {
        $custom = '';
        if (isset($this->headerExtras['custom']) && !empty($this->headerExtras['custom'])) {
            $custom = $this->headerExtras['custom'];
        }

        $css = 'LobsterTwo.css,Belleza.css,main.css,';
        if (isset($this->headerExtras['css'])) {
            foreach ($this->headerExtras['css'] as $cssFile) {
                $css .= $cssFile . ',';
            }
        }
        $js = 'jquery-172.js,heights.js,';
        if (isset($this->headerExtras['js']) && !empty($this->headerExtras['js'])) {
            foreach ($this->headerExtras['js'] as $jsFile) {
                $js .= $jsFile . ',';
            }
        }

        $css = substr($css, 0, -1);
        $js = substr($js, 0, -1);

        echo "<!doctype html>";
        echo "<html>";
        echo
        "
                <head>
                    <link rel='shortcut icon' href='/favicon.ico'>
                    " . $custom . "
                    <link rel='stylesheet' type='text/css' href='" . WEB_ROOT . "min/?b=css&f=" . $css . "&1235' />
                    <script type='text/javascript' src='" . WEB_ROOT . "min/?b=js&f=" . $js . "&1235'></script>
                    <script type='text/javascript'>
                        var _gaq = _gaq || [];
                        _gaq.push(['_setAccount', 'UA-23828542-1']);
                        _gaq.push(['_trackPageview']);

                        (function() {
                            var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
                            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
                        })();
                    </script>
                ";
        echo "<title>" . $this->title . "</title>";
        echo '<meta property="og:title" content="' . $this->title . '" />
                  <meta property="og:image" content="http://www.mvhpc.org/images/MVHPC-Logo-Brown.png" />
                  <meta property="og:description" content="Welcome to the exciting past and present of an unusual small community in the heart of the Heartland! This site opens our historical resources to the Internet and invites you to share in adding information, correcting our sources, and asking us for specific information you cannot find here. This site is an organic history book ‚ it continues to grow from the input and knowledge of anyone in the world. Almost all of our known historical resources will eventually be available on this website." />';
        echo "</head>";

        echo
        "
                <body>
                    <div class='container'>
                        <div class='header'>
                        <a href='" . WEB_ROOT . "'>
                            <img id='logo' src='" . WEB_ROOT . "images/MVHPC-Logo.png' alt='MVHPC Logo' />
                        </a>
                        <div class='header_text'>
                            <h1 class='pie'>Mount Vernon Historic Preservation Commission</h1>
                        </div>
                        </div>
                        <div class='navbar'>
                            <div class='menu'>
                                <span class='menu_wrapper'>
                                    <a href='" . WEB_ROOT . "'><span class='" . $this->outputNavClass('home') . " pie'>Home</span></a>
                                    <a href='" . WEB_ROOT . "archives'><span class='" . $this->outputNavClass('archives') . "'>Archives</span></a>
                                    <a href='" . WEB_ROOT . "map'><span class='" . $this->outputNavClass('map') . "'>Map</span></a>
                                    <a href='" . WEB_ROOT . "making-history'><span class='" . $this->outputNavClass('making-history') . "'>Making History</span></a>
                                    <a href='" . WEB_ROOT . "about'><span class='" . $this->outputNavClass('about') . "'>About</span></a>
                                </span>
                            </div>
                        </div>
                ";
        if ($this->style == "oneColumn") {
            echo "<div class='content oneColumn'>";
            echo "<div class='single_col'>";
            echo $this->singleCol;
            echo "</div>";
        } else if ($this->style == "twoColumn") {
            echo "<div class='content twoColumn'>";
            echo "<div class='left_col'>";
            echo $this->leftCol;
            echo "</div>";
            echo "<div class='right_col'>";
            echo $this->rightCol;
            echo "</div>";
        }
        echo "
                            <div class='clear'></div>
                            <div class='footer'>
                                <div class='body_text' style='text-align: center; margin: 0'>
                                    <a href='" . WEB_ROOT . "'><span title='Click here to go to the home page' class='footer_item'>Home</span></a><span class='bullet'>&bull;</span>
                                    <a href='" . WEB_ROOT . "archives'><span title='Click here to go to the archives' class='footer_item'>Archives</span></a><span class='bullet'>&bull;</span>
                                    <a href='" . WEB_ROOT . "archives/documents'><span title='Click here to view historical documents' class='footer_item'>Documents</span></a><span class='bullet'>&bull;</span>
                                    <a href='" . WEB_ROOT . "archives/images'><span title='Click here to search images' class='footer_item'>Images</span></a><span class='bullet'>&bull;</span>
                                    <a href='" . WEB_ROOT . "map'><span title='Click here to view a map of Mount Vernon' class='footer_item'>Map</span></a><span class='bullet'>&bull;</span>
                                    <a href='" . WEB_ROOT . "map/ash-park'><span title='Click here to view the Ash Park District' class='footer_item'>Ash Park District</span></a><span class='bullet'>&bull;</span>
                                    <a href='" . WEB_ROOT . "map/commercial'><span title='Click here to view the Commercial District' class='footer_item'>Commercial District</span></a><span class='bullet'>&bull;</span>
                                    <a href='" . WEB_ROOT . "map/cornell-college'><span title='Click here to view the Cornell District' class='footer_item'>Cornell District</span></a><br>
                                    <a href='" . WEB_ROOT . "making-history'><span title='Click here to see Mount Vernon Public School's contribution to History' class='footer_item'>Making History</span></a><span class='bullet'>&bull;</span>
                                    <a href='" . WEB_ROOT . "about'><span title='Click here to find out about the commission' class='footer_item'>About</span></a><span class='bullet'>&bull;</span>
                                    <a href='" . WEB_ROOT . "about/design-review'><span title='Click here to the guidelines on design review' class='footer_item'>Design Review</span></a><span class='bullet'>&bull;</span>
                                    <a href='" . WEB_ROOT . "about#resources'><span title='Click here to view useful links' class='footer_item'>Resources</span></a><span class='bullet'>&bull;</span>
                                    <a href='" . WEB_ROOT . "pages/contact-form.php'><span title='Click here to contact us' class='footer_item'>Contact</span></a><span class='bullet'>&bull;</span>
                                    <a href='" . WEB_ROOT . "backend/login.php'><span title='Click here to login' class='footer_item'>Login</span></a><span class='bullet'>&bull;</span>
                                    &copy; 2012 by MVHPC
                                </div>
                            </div>
                        </div>
                    </div>
                </body>
                ";
        echo "</html>";
    }

}
  //TODO: ADD DEVELOPED BY

