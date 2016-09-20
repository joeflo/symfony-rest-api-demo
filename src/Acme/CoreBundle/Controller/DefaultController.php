<?php

namespace Acme\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('AcmeCoreBundle:Default:index.html.twig');
    }
}
