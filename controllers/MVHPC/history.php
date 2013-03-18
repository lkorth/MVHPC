<?php

namespace MVHPC {

    use Silex\Application;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Response;

    class History {

        public function makingHistory(Application $app, Request $request) {
            $response = new Response($app['twig']->render('making.history.twig', array('page' => 'making-history')));
            $response->setPublic();
            $response->setEtag(md5($response->getContent()));
            $response->isNotModified($request);

            return $response;
        }
    }
}