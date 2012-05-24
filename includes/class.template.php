<?php
    class Template
    {
        private $DEFAULT_TITLE = "Mount Vernon Historical Preservation Commission";
        private $DEFAULT_BODY = "There was an error finding the content for this page. Please contact the system administrator for assistance.";
                
        private $style;
        private $title;
        private $headerExtras;
        private $body;
        
        public function _construct() {
            $this->style = "oneColumn";
            $this->title = $DEFAULT_TITLE;
            $this->body = $DEFAULT_BODY;
        }
        
        public function setStyle($style) {
            $this->style = $style;
        } 
        
        public function setTitle($title) {
            $this->title = $title;
        }
        
        public function setHeaderExtras($extras) {
            $this->headerExtras = $extras;
        }
        
        public function setBody($body) {
            $this->body = $body;
        }
        
        public function output() {
            echo "<html>";
            echo 
                "
                <head>
                    <link href='http://fonts.googleapis.com/css?family=Lobster+Two' rel='stylesheet' type='text/css' />
                    <link href='http://fonts.googleapis.com/css?family=Glass+Antiqua' rel='stylesheet' type='text/css' />
                    <link rel='stylesheet' type='text/css' href='" . WEB_ROOT . "beta/stylesheets/compiled/main.css' />
                    <script src='" . WEB_ROOT . "js/jquery-1.7.2.js'></script>
                    <script src='" . WEB_ROOT . "beta/js/script.js'></script>
                ";
            echo "<title>".$this->title."</title>";
            echo $this->headerExtras;
            echo "</head>";
            
            echo 
                "
                <body>
                    
                    <div class='container'>
                        <div class='header'>
                        <img id='logo' src='" . WEB_ROOT . "images/MVHPC-Logo.png' alt='MVHPC Logo' />
                        </div>
                        <div class='navbar'>
                            <div class='menu'>
                                <span class='menu_wrapper'>
                                    <a href='#'><span class='menu_item'>Home</span></a>
                                    <a href='#'><span class='menu_item'>Archives</span></a>
                                    <a href='#'><span class='menu_item'>Map</span></a>
                                    <a href='#'><span class='menu_item'>About</span></a>
                                </span>
                            </div>
                        </div>
                ";
            if($this->style == "oneColumn"){
                echo "<div class='content oneColumn'>";
            }else if($this->style == "twoColumn"){
                echo "<div class='content twoColumn'>";
            }
            echo $this->body;
            echo "
                        </div>
                    </div>
                </body>
                ";
            echo "</html>";
        }   
    }
