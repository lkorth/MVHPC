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

        $photos = $this->getDoctrine()->getRepository('MVHPCWebBundle:Search')->findAll();

        $tags = array();
        foreach($photos as $photo){
            $tmp = explode(';', $photo->getTags());
            foreach($tmp as $tg){
                $tg = trim($tg);
                if(isset($tags[$tg]))
                    $tags[$tg]++;
                else
                    $tags[$tg] = 1;
            }
        }

        asort($tags);
        $tags = array_slice($tags, count($tags) - 100, count($tags));

        $output = array();
        foreach($tags as $key => $value){
            if($key !== '' && $value > 5 && strlen($key) <= 15 && $key != 'mount vernon' && $key != 'needstobetagged' && $key != 'new')
                $output[] = array('tag' => $key, 'count' => $value);
        }

        $output = array_slice($output, count($output) - 25, count($output));
        shuffle($output);

        return array('page' => 'home', 'images' => $images, 'tags' => $output, 'post' => $post);
    }
}
