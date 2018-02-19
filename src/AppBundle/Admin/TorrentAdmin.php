<?php

namespace AppBundle\Admin;

use AppBundle\Entity\Genre;
use AppBundle\Entity\Quality;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelListType;
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
            ->with('General', ['class' => 'col-md-6'])
            ->add('file', 'file', ['required' => false])
            ->add('magnetLink')
            ->end()
            ->with('Quality', ['class' => 'col-md-6'])
            ->add('quality', ModelListType::class, [
                'class' => Quality::class,
                'label' => 'Format',
                'btn_delete' => false,
            ])
            ->end();
    }

    protected function configureShowFields(ShowMapper $showMapper) {
        $showMapper
            ->add('fileName')
            ->add('fileSize')
            ->add('magnetLink');
    }
}
