<?php

namespace AppBundle\Admin;

use AppBundle\Entity\Movie;
use Knp\Menu\ItemInterface as MenuItemInterface;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
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
            ->add('id')
            ->addIdentifier('name')
            ->add('poster')
            ->add('genres')
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
            ->add('torrentFileName')
            ->add('youtubeLink')
            ->add('imdbLink')
            ->add('posterName')
            ->add('posterSize')
            ->add('updatedAt')
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
            ->add('name', 'text')
            ->add('size', 'text')
            ->add('posterImage', 'file')
            ->add('posterName', 'text')
            ->add('runtime', 'text')
            ->add('language', 'text')
            ->add('releaseDate', 'date')
            ->add('directors', 'textarea')
            ->add('writers', 'textarea')
            ->add('cast', 'textarea')
            ->add('description', 'textarea')
            ->add('imdbRating', 'number')
            ->add('youtubeLink', 'text')
            ->add('imdbLink', 'text');

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
