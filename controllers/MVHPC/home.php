<?php

namespace MVHPC {

    use Silex\Application;
    use Symfony\Component\HttpFoundation\Response;

    class Home {

        public function index(Application $app) {
            global $js;

            $arr = array();
            $arr['page'] = 'home';
            $arr['images'] = featuredImages();
            $arr['post'] = returnPosts('index', 1);
            $arr['post'] = $arr['post'][0];
            array_push($js, 'image-script.js');
            $arr['js'] = $js;

            // page will not be cached at this time, due to random images
            return new Response($app['twig']->render('index.twig', $arr));
        }
    }
}