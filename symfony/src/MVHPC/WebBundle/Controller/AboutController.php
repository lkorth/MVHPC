<?php

namespace MVHPC\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class AboutController extends Controller
{
    /**
     * @Route("/about")
     * @Template()
     */
    public function indexAction()
    {
        return array('page' => 'about');
    }
}
