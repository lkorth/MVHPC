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
            $custom = '';
            if(isset($this->headerExtras['custom']) && !empty($this->headerExtras['custom'])){
                $custom = $this->headerExtras['custom'];
            }

            $css = 'main.css,';
            if(isset($this->headerExtras['css'])){
                foreach($this->headerExtras['css'] as $cssFile){
                    $css .= $cssFile . ',';
                }
            }

            $js = '';
            if(isset($this->headerExtras['js']) && !empty($this->headerExtras['js'])){
                foreach($this->headerExtras['js'] as $jsFile){
                    $js .= $jsFile . ',';
                }
            }

            $css = substr($css, 0, -1);
            $js = substr($js, 0, -1);

            echo "<html>";
            echo
                "
                <head>
                    <link rel='shortcut icon' href='/favicon.ico'>
                    <link href='http://fonts.googleapis.com/css?family=Lobster+Two' rel='stylesheet' type='text/css' />
                    <link href='http://fonts.googleapis.com/css?family=Glass+Antiqua' rel='stylesheet' type='text/css' />
                    " . $custom . "
                    <link rel='stylesheet' type='text/css' href='" . WEB_ROOT . "min/?b=css&f=" . $css . "&1234' />
                    <script type='text/javascript' src='" . WEB_ROOT . "min/?b=js&f=" . $js . "&1234'></script>
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
            echo "<title>".$this->title."</title>";
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
                            <h1>Mount Vernon Historical Preservation Commission</h1>
                        </div>
                        </div>
                        <div class='navbar'>
                            <div class='menu'>
                                <span class='menu_wrapper'>
                                    <a href='" . WEB_ROOT . "'><span class='menu_item'>Home</span></a>
                                    <a href='" . WEB_ROOT . "archives'><span class='menu_item'>Archives</span></a>
                                    <a href='" . WEB_ROOT . "map'><span class='menu_item'>Map</span></a>
                                    <a href='" . WEB_ROOT . "about'><span class='menu_item'>About</span></a>
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
