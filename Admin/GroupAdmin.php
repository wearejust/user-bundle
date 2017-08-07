<?php

namespace Wearejust\UserBundle\Admin;

use Sonata\UserBundle\Admin\Entity\GroupAdmin as BaseGroupAdmin;
use Wearejust\AdminBundle\Admin\Traits\DisableDefaults;

class GroupAdmin extends BaseGroupAdmin
{
    use DisableDefaults;
}
