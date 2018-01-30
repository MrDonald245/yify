<?php

namespace AppBundle\Admin;

use AppBundle\Entity\Role;
use Knp\Menu\ItemInterface as MenuItemInterface;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class UserAdmin extends AbstractAdmin
{
    protected function configureDatagridFilters(DatagridMapper $datagridMapper) {
        $datagridMapper
            ->add('id')
            ->add('username')
            ->add('password')
            ->add('email');
    }

    protected function configureListFields(ListMapper $listMapper) {
        $listMapper
            ->addIdentifier('username')
            ->add('email')
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
            ->with('General' , ['class' => 'col-md-6'])
            ->add('username')
            ->add('password')
            ->add('email')
            ->end()
            ->with('Roles', ['class' => 'col-md-6'])
            ->add('roles', 'sonata_type_model', [
                'class' => Role::class,
                'label' => 'Names',
                'btn_delete' => false,
                'multiple' => true,
                'required' => true,
            ])
            ->end()
        ;
    }

    protected function configureShowFields(ShowMapper $showMapper) {
        $showMapper
            ->add('id')
            ->add('username')
            ->add('password')
            ->add('email');
    }
}
