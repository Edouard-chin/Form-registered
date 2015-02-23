<?php

namespace Dudek\FormBundle\Controller\Front;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Dudek\FormBundle\Entity\Answer;
use Dudek\FormBundle\Entity\Form;
use Dudek\FormBundle\Form\AnswerType;

class FormController extends Controller
{
    public function populateAction(Form $form, Request $request)
    {
        $answerForm = $this->createForm(new AnswerType(), null, [
            'form' => $form,
        ]);

        $answerForm->handleRequest($request);
        if ($answerForm->isValid()) {
            $datas = $answerForm->all();
            foreach ($datas as $key => $value) {
                $em = $this->getDoctrine()->getManager();
                $question = $em->getRepository('DudekFormBundle:Question')->find(
                    substr($value->getName(), strpos($value->getName(), '-') + 1
                ));
                $answer = new Answer();
                $answer->setQuestion($question);
                $answer->setContent((!$value->getData() instanceof \DateTime) ? $value->getData() : $value->getData()->format('d-m-Y H:i'));
                $em->persist($answer);
            }
            $em->flush();
        }

        return $this->render('DudekFormBundle:Front/Form:populate.html.twig', [
            'answerForm' => $answerForm->createView(),
        ]);
    }
}
