<?php

namespace Dudek\FormBundle\EventListener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\GetResponseUserEvent;

class UserListener implements EventSubscriberInterface
{
    static public function getSubscribedEvents()
    {
        return [
            FOSUserEvents::REGISTRATION_CONFIRM => 'onRegistrationConfirm'
        ];
    }

    public function onRegistrationConfirm(GetResponseUserEvent $event)
    {
        $user = $event->getUser();
        $user->setPassword($user->getChosenPassword());
        $user->setChosenPassword(null);
    }
}
