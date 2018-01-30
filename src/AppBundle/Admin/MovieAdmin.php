<?php

namespace AppBundle\Admin;

use AppBundle\Entity\Genre;
use AppBundle\Entity\Movie;
use AppBundle\Entity\Screenshot;
use Knp\Menu\ItemInterface as MenuItemInterface;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelListType;
use Sonata\AdminBundle\Show\ShowMapper;

class MovieAdmin extends AbstractAdmin
{
    protected function configureSideMenu(MenuItemInterface $menu, $action, AdminInterface $childAdmin = null) {
        if (!$childAdmin && !in_array($action, ['edit', 'show'])) {
            return;
        }

        $admin = $this->isChild() ? $this->getParent() : $this;
        $id = $admin->getRequest()->get('id');

        if ($this->isGranted('EDIT')) {
            $menu->addChild('Movie', [
                'uri' => $this->generateUrl('edit', ['id' => $id])
            ]);
        }

        if ($this->isGranted('LIST')) {
            $menu->addChild('Torrent', [
                'uri' => $this->generateUrl('app.content.torrent.list', ['id' => $id])
            ]);
        }
    }

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper) {
        /**  $datagridMapper
         * ->add('id')
         * ->add('name')
         * ->add('quality')
         * ->add('size')
         * ->add('runtime')
         * ->add('language')
         * ->add('releaseDate')
         * ->add('directors')
         * ->add('writers')
         * ->add('cast')
         * ->add('description')
         * ->add('imdbRating')
         * ->add('magnetLink')
         * ->add('torrentFileName')
         * ->add('youtubeLink')
         * ->add('imdbLink')
         * ->add('posterName')
         * ->add('posterSize')
         * ->add('updatedAt'); */
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper) {
        $listMapper
            ->addIdentifier('id')
            ->addIdentifier('name')
            ->add('updatedAt')
            ->add('createdAt')
            ->add('_action', null, array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                ),
            ));
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper) {
        $formMapper
            ->with('General', ['class' => 'col-md-5'])
            ->add('name', 'text')
            ->add('size', 'text')
            ->add('posterImage', 'file', ['required' => false])
            ->add('runtime', 'text')
            ->add('language', 'text')
            ->add('releaseDate', 'date')
            ->end()
            ->with('Detailed info', ['class' => 'col-md-7'])
            ->add('directors', 'textarea')
            ->add('writers', 'textarea')
            ->add('cast', 'textarea')
            ->add('description', 'textarea')
            ->add('imdbRating', 'number')
            ->add('youtubeLink', 'text')
            ->add('imdbLink', 'text')
            ->end()
            ->with('Genres', ['class' => 'col-md-5'])
            ->add('genres', 'sonata_type_model', [
                'class' => Genre::class,
                'label' => 'Name',
                'btn_delete' => false,
                'multiple' => true,
                'required' => true,
            ])
            ->end()
            ->with('Screenshots', ['class' => 'col-md-7'])
            ->add('screenshots', 'sonata_type_collection', array(
                'by_reference' => false,
                'required' => false,
            ), array(
                'edit' => 'inline',
                'inline' => 'table'
            ))
            ->end();

        /**
         *
         * ->add('genres', 'entity', [
         * 'class' => 'AppBundle\Entity\Genre',
         * 'choice_label' => 'name',
         * 'placeholder' => '---',
         * 'multiple' => true,
         * 'required' => false,
         * 'choices' => $this->getModelManager()->findBy(Genre::class),
         * ]);
         */
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper) {
        /* $showMapper
             ->add('id')
             ->add('name')
             ->add('quality')
             ->add('size')
             ->add('runtime')
             ->add('language')
             ->add('releaseDate')
             ->add('directors')
             ->add('writers')
             ->add('cast')
             ->add('description')
             ->add('imdbRating')
             ->add('magnetLink')
             ->add('torrentFileLink')
             ->add('youtubeLink')
             ->add('imdbLink')
             ->add('posterName')
             ->add('posterSize')
             ->add('updatedAt'); */
    }

    /**
     * @param Movie $object
     * @return string
     */
    public function toString($object): string {
        return $object instanceof Movie
            ? $object->getName()
            : 'Movie';
    }
}
