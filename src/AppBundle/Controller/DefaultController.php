<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route(
     *    "/{_locale}/", 
     *    name="homepage", 
     *    requirements={
     *       "_locale": "en|de"
     *    }
     * )
     */
    public function indexAction(Request $request)
    {
        return  $this->render('AppBundle:Default:index.html.twig');
    }
}
