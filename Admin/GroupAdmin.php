<?php

namespace Wearejust\UserBundle\Admin;

use Sonata\UserBundle\Admin\Entity\GroupAdmin as BaseGroupAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;

class GroupAdmin extends BaseGroupAdmin
{
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
     *
     * @return \Sonata\AdminBundle\Datagrid\DatagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $filterMapper)
    {
        return $filterMapper;
    }
}
