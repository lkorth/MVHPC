<?php

namespace MVHPC\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class MVHPCController extends Controller
{
    /**
     * @Route("/")
     * @Template()
     */
    public function indexAction()
    {
        $images = $this->getDoctrine()->getRepository('MVHPCWebBundle:Search')->findBy(
            array('live' => 1),
            array('trueviews' => 'DESC'),
            5
        );

        $post = $this->getDoctrine()->getRepository('MVHPCWebBundle:Posts')
            ->findOneBy(array('page' => 'index'),
                        array('date' => 'DESC'));

        return array('page' => 'home', 'images' => $images, 'post' => $post);
    }
}
