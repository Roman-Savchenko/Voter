<?php

namespace VoterBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class VoterBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
