<?php

namespace MVHPC {

    use Silex\Application;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Response;

    class About {

        public function index(Application $app, Request $request) {
            $response = new Response($app['twig']->render('about.twig', array('page' => 'about')));
            $response->setPublic();
            $response->setEtag(md5($response->getContent()));
            $response->isNotModified($request);

            return $response;
        }
    }
}