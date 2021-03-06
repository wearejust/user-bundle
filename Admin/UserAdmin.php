<?php

namespace Wearejust\UserBundle\Admin;

use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\UserBundle\Admin\Entity\UserAdmin as BaseUserAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;

class UserAdmin extends BaseUserAdmin
{
    /**
     * @param array $actions
     *
     * @return array
     */
    protected function configureBatchActions($actions)
    {
        unset($actions['delete']);

        return parent::configureBatchActions($actions);
    }

    /**
     * @param \Sonata\AdminBundle\Route\RouteCollection $collection
     */
    protected function configureRoutes(RouteCollection $collection)
    {
        parent::configureRoutes($collection);

        $collection->remove('show');
        $collection->remove('export');
        $collection->remove('batch');
    }

    /**
     * Disable all export formats by default, off course you can override this
     * action when needed.
     *
     * https://sonata-project.org/bundles/admin/master/doc/reference/action_export.html
     *
     * @return array
     */
    public function getExportFormats()
    {
        return [];
    }

    /**
     * Disable the filters on the list page by default, off course you can enable
     * it when needed.
     *
     * https://sonata-project.org/bundles/admin/master/doc/reference/action_list.html
     *
     * @param \Sonata\AdminBundle\Datagrid\DatagridMapper $filterMapper
     */
    protected function configureDatagridFilters(DatagridMapper $filterMapper): void
    {
        //
    }

    /**
     * {@inheritdoc}
     */
    protected function configureListFields(ListMapper $listMapper): void
    {
        $listMapper
            ->add('email')
            ->add('enabled', null, array('editable' => true))
        ;

        if ($this->isGranted('ROLE_SUPER_ADMIN')) {
            $listMapper
                ->add('impersonating', 'string', array('template' => 'SonataUserBundle:Admin:Field/impersonating.html.twig'))
            ;
        }

        if ($this->isGranted('ROLE_SUPER_ADMIN')) {
            $listMapper->add('_action', null, [
                'actions' => [
                    'edit' => [],
                    'delete' => [],
                ],
            ]);
        }
    }

    /**
     * @param \Sonata\AdminBundle\Form\FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper): void
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
//                ->add('groups', 'Sonata\AdminBundle\Form\Type\ModelType', [
//                    'required' => false,
//                    'expanded' => true,
//                    'multiple' => true,
//                ])
                ->add('realRoles', 'Sonata\UserBundle\Form\Type\SecurityRolesType', [
                    'label' => 'form.label_roles',
                    'expanded' => false,
                    'multiple' => true,
                    'required' => false,
                ])
            ->end();
    }
}
