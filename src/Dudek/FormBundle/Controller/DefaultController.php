<?php

namespace Dudek\FormBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('DudekFormBundle:Default:index.html.twig', array('name' => $name));
    }
}
