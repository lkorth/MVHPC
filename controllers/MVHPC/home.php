<?php

namespace MVHPC {

    use Silex\Application;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Response;

    class Home {

        public function index(Application $app, Request $request) {
            global $js;

            $arr = array();
            $arr['page'] = 'home';
            $arr['images'] = featuredImages();
            $arr['post'] = returnPosts('index', 1);
            $arr['post'] = $arr['post'][0];
            array_push($js, 'image-script.js');
            $arr['js'] = $js;

            $response = new Response($app['twig']->render('index.twig', $arr));
            $response->setPublic();
            $response->setEtag(md5($response->getContent()));
            $response->isNotModified($request);

            return $response;
        }
    }
}