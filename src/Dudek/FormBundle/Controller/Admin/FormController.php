<?php

namespace Dudek\FormBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Dudek\FormBundle\Entity\Form;

class FormController extends Controller
{
    public function indexAction()
    {
        exit('index');
    }

    public function createAction()
    {
        die('create');
    }
}
