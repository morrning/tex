<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/admin/dashboard", name="adminDashboard")
     */
    public function dashboard()
    {
        return $this->render('AdminBundle:Def:dashboard.html.twig');
    }
}
