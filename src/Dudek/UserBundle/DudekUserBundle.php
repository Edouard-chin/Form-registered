<?php

namespace Dudek\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class DudekUserBundle extends Bundle
{
	public function getParent()
    {
        return 'FOSUserBundle';
    }
}
