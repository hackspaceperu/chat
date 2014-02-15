<?php

namespace HackspaceUni\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class HackspaceUniUserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
