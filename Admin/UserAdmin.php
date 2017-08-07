<?php

namespace Wearejust\UserBundle\Admin;

use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\UserBundle\Admin\Entity\UserAdmin as BaseUserAdmin;
use Wearejust\AdminBundle\Admin\Traits\DisableDefaults;

class UserAdmin extends BaseUserAdmin
{
    use DisableDefaults;

    /**
     * {@inheritdoc}
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('username')
            ->add('email')
            ->add('enabled', null, array('editable' => true))
        ;

        if ($this->isGranted('ROLE_ALLOWED_TO_SWITCH')) {
            $listMapper
                ->add('impersonating', 'string', array('template' => 'SonataUserBundle:Admin:Field/impersonating.html.twig'))
            ;
        }
    }

    /**
     * @param \Sonata\AdminBundle\Form\FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('General')
                    ->add('username')
                    ->add('firstname', null, ['required' => false])
                    ->add('lastname', null, ['required' => false])
            ->end()
            ->with('Login')
                ->add('enabled', null, ['required' => false])
                ->add('email')
                ->add('plainPassword', 'Symfony\Component\Form\Extension\Core\Type\TextType', [
                    'required' => (!$this->getSubject() || is_null($this->getSubject()->getId())),
                ])
            ->end()
            ->with('Security')
                ->add('groups', 'Sonata\AdminBundle\Form\Type\ModelType', [
                    'required' => false,
                    'expanded' => true,
                    'multiple' => true,
                ])
                ->add('realRoles', 'Sonata\UserBundle\Form\Type\SecurityRolesType', [
                    'label' => 'form.label_roles',
                    'expanded' => false,
                    'multiple' => true,
                    'required' => false,
                ])
            ->end();
    }
}
