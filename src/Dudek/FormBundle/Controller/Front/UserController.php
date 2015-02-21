<?php

namespace Dudek\FormBundle\Controller\Front;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContextInterface;

use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\FOSUserEvents;

use Dudek\FormBundle\Exception\AuthenticationFailedException;
use Dudek\UserBundle\Form\RegistrationFormType;

class UserController extends Controller
{
    public function registerAction(Request $request)
    {
        $session = $request->getSession();
        $userManager = $this->get('fos_user.user_manager');
        $user = $userManager->findUserBy(['username' => $request->request->get('_username')]);
        if (!$user) {
            $session->set(SecurityContextInterface::AUTHENTICATION_ERROR, new AuthenticationFailedException('Impossible de trouver cet uid'));
            return $this->redirectToRoute('fos_user_security_login');
        }
        $form = $this->createForm(new RegistrationFormType(), $user);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $dispatcher = $this->get('event_dispatcher');
            $event = new FormEvent($form, $request);
            $dispatcher->dispatch(FOSUserEvents::REGISTRATION_SUCCESS, $event);
            $userManager->updateUser($user);
        }

        return $this->render('DudekUserBundle::register.html.twig', [
            'form' => $form->createView(),
            'user' => $user
        ]);
    }
}
