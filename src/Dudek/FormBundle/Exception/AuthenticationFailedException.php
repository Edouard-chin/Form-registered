<?php

namespace Dudek\FormBundle\Exception;

use Symfony\Component\Security\Core\Exception\AuthenticationException;

class AuthenticationFailedException extends AuthenticationException
{
    /**
     * Message key to be used by the translation component.
     *
     * @return string
     */
    public function getMessageKey()
    {
        return $this->getMessage();
    }

}
