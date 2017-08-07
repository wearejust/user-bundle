<?php

namespace Wearejust\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class WearejustUserBundle extends Bundle
{
    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return 'SonataUserBundle';
    }
}
