<?php

namespace Digitar\AssurexBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('DigitarAssurexBundle:Default:index.html.twig');
    }
}
