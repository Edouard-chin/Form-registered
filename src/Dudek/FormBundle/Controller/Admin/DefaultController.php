<?php

namespace Dudek\FormBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('DudekFormBundle:Admin:index.html.twig');
    }
}
