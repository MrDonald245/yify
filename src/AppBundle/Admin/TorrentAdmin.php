<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class TorrentAdmin extends AbstractAdmin
{
    public function getParentAssociationMapping() {
        return 'movie';
    }


    protected function configureDatagridFilters(DatagridMapper $datagridMapper) {
        $datagridMapper
            ->add('id')
            ->add('fileName')
            ->add('fileSize')
            ->add('magnetLink');
    }

    protected function configureListFields(ListMapper $listMapper) {
        $listMapper
            ->addIdentifier('fileName')
            ->add('_action', null, [
                'actions' => [
                    'show' => [],
                    'edit' => [],
                    'delete' => [],
                ],
            ]);
    }

    protected function configureFormFields(FormMapper $formMapper) {
        $formMapper
            ->add('fileName')
            ->add('magnetLink');
    }

    protected function configureShowFields(ShowMapper $showMapper) {
        $showMapper
            ->add('fileName')
            ->add('fileSize')
            ->add('magnetLink');
    }
}
