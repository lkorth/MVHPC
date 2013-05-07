<?php

namespace MVHPC;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

class Admin {

    public function login(Application $app, Request $request) {
        return $app->render('login.twig', array(
            'error'         => $app['security.last_error']($request),
            'last_username' => $app['session']->get('_security.last_username')
        ));
    }
}