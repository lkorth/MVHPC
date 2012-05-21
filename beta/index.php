<!doctype html>

<?php

error_reporting('E_ALL');

include('../includes/master.inc.php');

$posts = returnPosts('index', 2);

?>

<html>
    <head>
        <title>Mount Vernon Historical Preservation Commission</title>
        <link href='http://fonts.googleapis.com/css?family=Lobster+Two' rel='stylesheet' type='text/css' />
        <link href='http://fonts.googleapis.com/css?family=Glass+Antiqua' rel='stylesheet' type='text/css' />
        <link rel="stylesheet" type="text/css" href="stylesheets/compiled/main.css" />
        <script src="/mvhpc/js/jquery-1.7.2.js"></script>
        <script src="js/script.js"></script>
    </head>
    <body>
        <div class="container">
            <div class="header">

            </div>
            <div class="navbar">
                <div class="menu">
                    <span class="menu_wrapper">
                        <a href='#'><span class="menu_item">Home</span></a>
                        <a href='#'><span class="menu_item">About</span></a>
                        <a href='#'><span class="menu_item">Services</span></a>
                        <a href='#'><span class="menu_item">Contact</span></a>
                    </span>
                </div>
            </div>
            <div class="content">
                    <div class="newsfeed">
                        <?php foreach($posts as $post): ?>
                        <h1 class="ribbon"><?php echo $post['title']; ?></h1>
                        <div class="article">
                            <p>
                                <?php echo max_words($post['text'], 200); ?>
                            </p>
                            <a href="<?php WEBROOT() ?>pages/posts.php?id=<?php echo $post['id']; ?>">Read more...</a>
                        </div>
                        <?php endforeach; ?>
                    </div>
                <div class="left_box">
                    <div>
                        <h1 class="ribbon">Featured Images</h1>
                        <div class="featured_images">
                        <?php $imgArr = featuredImages();
                              $cnt = 0;
                              foreach($imgArr as $img): ?>
                                <?php if($cnt == 0): ?>
                                    <div class="featured current">
                                <?php else: ?>
                                        <div class="featured">
                                <?php endif; ?>
                                <a href="<?php WEBROOT(); ?>pages/fullsize.php?id=<?php echo $img['id']; ?>"><img src="<?php echo WEB_ROOT . $img['thumbnail']; ?>" /></a>
                            </div>
                        <?php
                            $cnt++;
                        endforeach; ?>
                        </div>
                        <span style="display:block; margin:0 auto; color: #FF6600;"><button id="prevImg"><</button> ooooo <button id="nextImg">></button></span>
                    </div>
                    <div>
                        <h1 class="ribbon">Common Tags</h1>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>