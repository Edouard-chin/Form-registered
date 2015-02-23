<?php

namespace Dudek\FormBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Dudek\FormBundle\Entity\Form;
use Dudek\FormBundle\Entity\Step;
use Dudek\FormBundle\Form\FormType;
use Dudek\FormBundle\Form\StepType;


class FormController extends Controller
{
    public function indexAction()
    {
        exit('index');
    }

    public function createAction(Request $request)
    {
        $form = new Form();
        $formType = $this->createForm(new FormType(), $form);
        $formType->handleRequest($request);
        if ($formType->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($form);
            $em->flush();

            return $this->redirectToRoute('back_form_add_step', ['id' => $form->getId()]);
        }

        return $this->render('DudekFormBundle:Admin/Form:create.html.twig', [
            'formType' => $formType->createView(),
        ]);
    }

    public function addStepAction(Form $form, Request $request)
    {
        $step = new Step();
        $formStep = $this->createForm(new StepType(), $step);
        $formStep->handleRequest($request);
        if ($formStep->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $form->addStep($step);
            $em->flush();
            if ($formStep->get('previous')->isClicked()) {
            } elseif ($formStep->get('next')->isClicked()) {
                return $this->redirectToRoute('back_form_add_step', ['id' => $form->getId()]);
            }
        }

        return $this->render('DudekFormBundle:Admin/Form:addStep.html.twig', [
            'formStep' => $formStep->createView(),
            'form' => $form,
        ]);
    }

    private function getPreviousStep(Form $form, Step $step)
    {

    }
}
