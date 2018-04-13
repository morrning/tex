<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class trnslatorController extends Controller
{

    /**
     * @Route("/trans/dashboard", name="transDashboard")
     */
    public function transDashboard()
    {
        if (!$this->get('user.mgr')->IsLogedIn())
            return $this->redirectToRoute('userLogin');

        return $this->render('AppBundle:user:translatorDashboard.html.twig',
            [
                'user'=>$this->get('user.mgr')->getThisUserInfo()
            ]
        );

    }
}
