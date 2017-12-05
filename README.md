# wearejust/user-bundle

This package is basically a small wrapper around Sonata User bundle

Installation
============

__Hint:__ Coming from 0.x? Please check out our [upgrade guide](UPGRADE-1.0.md)

Step 1: Download the Bundle
---------------------------

Open a command console, enter your project directory and execute the
following command to download the latest stable version of this bundle:

```console
$ composer require wearejust/user-bundle "^1.0"
```

This command requires you to have Composer installed globally, as explained
in the [installation chapter](https://getcomposer.org/doc/00-intro.md)
of the Composer documentation.

Step 2: Enable the Bundle
-------------------------

Then, enable the bundle by adding it to the list of registered bundles
in the `app/AppKernel.php` file of your project:

```php
<?php
// app/AppKernel.php

// ...
class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            // ...

            new Wearejust\UserBundle\WearejustUserBundle(),
        );

        // ...
    }

    // ...
}
```

Step 3: Define your User/Group Entity
-------------------------

```php
// User

<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Sonata\UserBundle\Entity\BaseUser;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
}

```

```php
// Group

<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Sonata\UserBundle\Entity\BaseGroup;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user_group")
 */
class Group extends BaseGroup
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
}

```

Step 4: Configure
-------------------------

```yml
// config.yml

fos_user:
    db_driver:      orm
    firewall_name:  main
    user_class:     'Path\To\Custom\User\Entity'

    group:
        group_class: 'Path\To\Custom\Group\Entity'
        group_manager: sonata.user.orm.group_manager

    service:
        user_manager: sonata.user.orm.user_manager

    from_email:
        address: "%mailer_user%"
        sender_name: "%mailer_user%"
        

sonata_user:
    class:
        user: 'Path\To\Custom\User\Entity'
        group: 'Path\To\Custom\Group\Entity'

    admin:
        user:
            class: Wearejust\UserBundle\Admin\UserAdmin
        group:
            class: Wearejust\UserBundle\Admin\GroupAdmin

    impersonating:
        route: sonata_admin_dashboard
        

```
