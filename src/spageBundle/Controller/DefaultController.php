<?php

namespace spageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{

    /**
     * @Route("/message/401" , name="401")
     */
    public function indexAction()
    {
        return $this->render('spageBundle:Default:401.html.twig');
    }

    /**
     * @Route("/message/404" , name="404")
     */
    public function notFound()
    {
        return $this->render('spageBundle:Default:404.html.twig');
    }
    /**
     * @Route("/message/le" , name="le")
     */
    public function expireKey()
    {
        return $this->render('spageBundle:Default:le.html.twig');
    }

    /**
     * @Route("/message/so" , name="so")
     */
    public function siteOffline()
    {
        return $this->render('spageBundle:Default:so.html.twig');
    }

}
