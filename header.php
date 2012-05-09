<!doctype html>
<html lang="en">
    <head>
        <meta content="text/html;charset=UTF-8" http-equiv="Content-type"/>
        <link REL="SHORTCUT ICON" HREF="favicon.ico"> 
       <?php if(isset($upload) && $upload!=null)
            echo $upload;
        ?>
        <?php if (isset($delete) && $delete == 1) { ?>
        <script type="text/javascript" src="js/delete.js"></script>
        <?php } ?>
        <?php if (isset($update) && $update == 1) { ?>
        <script type="text/javascript" src="js/update.js"></script>
        <?php } ?>
        <?php if (isset($tag) && $tag != 1) { ?>
        <script type="text/javascript" src="tiny_mce/tiny_mce.js"></script>
        <script type="text/javascript" src="tiny_mce/options.js"></script>
        <?php } ?>
        <?php if(isset($upload) && !($upload!=null)) { ?>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
        <script type='text/javascript' src='js/jquery.bgiframe.min.js'></script>
        <script type='text/javascript' src='js/jquery.ajaxQueue.js'></script>
        <script type='text/javascript' src='js/jquery.autocomplete.js'></script>
        <script type='text/javascript' src='js/inpage_script.js'></script>
        <link rel="stylesheet" type="text/css" href="css/jquery.autocomplete.css" />
        <?php }
        else { ?>
        <script type="text/javascript" src="js/mootools.js"></script>
        <script type="text/javascript" src="js/Swiff.Uploader.js"></script>
        <script type="text/javascript" src="js/Fx.ProgressBar.js"></script>
        <script type="text/javascript" src="js/Lang.js"></script>
        <script type="text/javascript" src="js/FancyUpload2.js"></script>
        <script type="text/javascript" src="js/script.js"></script>
        <?php } ?>
        <link href="css/silhouette.css" type="text/css" rel="stylesheet" />
        <link rel="stylesheet" href="css/magiczoom.css" type="text/css" />
        <title><?php echo $title; ?></title>
        <script type="text/javascript" src="js/magiczoom.js"></script>
        <?php if(isset($all) && $all == 1) { ?>
        <script type="text/javascript" src="js/AJS.js"></script>
	<script type="text/javascript" src="js/googiespell.js"></script>
	<script type="text/javascript" src="js/cookiesupport.js"></script>
	<link href="js/googiespell.css" rel="stylesheet" type="text/css" media="all" />
	<script type="text/javascript" src="js/prototype.js"></script>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script> 
        <script>
        var $j = jQuery.noConflict();
        function editfunction(id)
{
var value = '';
 $j.ajax({    //create an ajax request to check_use.php
        type: "GET",
        url: "check_use.php",
        data: 'id='+id,  //with the id as a parameter
        dataType: value,
        success: function(msg){
            if(parseInt(msg)==1){  //if no errors make text areas editable 
               alert('You may now begin editing this item. You have 1 hour to edit it before your changes are discarded');
               var info = 'info' + id;
	       var tags = 'tags' + id;
	       document.form[info].readOnly = false;
               document.form[tags].readOnly = false;
               document.getElementById('button' + id).style.visibility='visible';
               }
               else if(parseInt(msg)==0){
               alert('Someone else is editing this item at this time.  Please come back later.  This item will be available in 1 hour or less.'); 
               }
        }
    });
}
        </script>
        <script type="text/javascript" src="js/scriptaculous.js?load=effects,builder"></script>
        <script type="text/javascript" src="js/lightbox.js"></script>
        <link rel="stylesheet" href="css/lightbox.css" type="text/css" media="screen" />
       <?php  } ?>
       <?php if (isset($change) && $change == 1) { ?>
      <script>
        var $j = jQuery.noConflict();
        function editfunction(id)
{
var value = '';
 $j.ajax({    //create an ajax request to check_use.php
        type: "GET",
        url: "check_use.php",
        data: 'id='+id,  //with the id as a parameter
        dataType: value,
        success: function(msg){
            if(parseInt(msg)==1){  //if no errors make text areas editable 
               alert('You may now begin editing this item. You have 1 hour to edit it before your changes are discarded');
               var info = 'info' + id;
	       var tags = 'tags' + id;
	       document.form[info].readOnly = false;
               document.form[tags].readOnly = false;
               document.getElementById('button' + id).style.visibility='visible';
               }
               else if(parseInt(msg)==0){
               alert('Someone else is editing this item at this time.  Please come back later.  This item will be available in 1 hour or less.'); 
               }
        }
    });
}
        </script> 
        <?php } ?>
        <script type="text/javascript">
	  var _gaq = _gaq || [];
	  _gaq.push(['_setAccount', 'UA-23828542-1']);
	  _gaq.push(['_trackPageview']);
	
	  (function() {
	    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	  })();
	</script>
    </head>
    <body>
            <div id="header">
                <a href="index.php"><img src="images/header.jpg" border=0/></a>
            </div>
            <div id="container">
                <div id="navbar">
                	<ul>
				<li><a href="index.php">Home</a></li>
			</ul>
			<ul>
 				<li><a href="districts.php">Districts</a></li>
			</ul>
			<ul>
				<li><a href="history.php">History</a>
					<ul>
						<li><a href="text.php">Text</a></li>
						<li><a href="images.php">Images</a></li>
    				</ul> 
				</li>
			</ul>
			<ul>
  				<li><a href="about.php">About Us</a>
					<ul>
						<li><a href="links.php">Links</a></li>
						<li><a href="design_review.php">Design Review</a></li>
    				</ul> 
  				</li>
			</ul>
                            <div id="search">
                                <?php if (isset($upload) && !($upload != null)) { ?>
                                        <form enctype="multipart/form-data" action="search.php" method="GET" autocomplete="off">
                                            <input type="hidden" value="1" name="page" />
                                            <input name="terms" type="text" id="global"/>
                                            <input type="submit" value="Search" />
                                        </form>
                                <?php } ?>
                    </div>
                    <div id="clear"></div>
                </div>
                <div id="main">