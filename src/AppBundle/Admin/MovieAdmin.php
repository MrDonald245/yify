<?php

namespace AppBundle\Admin;

use AppBundle\Entity\Genre;
use AppBundle\Entity\Movie;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class MovieAdmin extends AbstractAdmin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
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
            ->add('torrentFileName')
            ->add('youtubeLink')
            ->add('imdbLink')
            ->add('posterName')
            ->add('posterSize')
            ->add('updatedAt')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
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
            ))
        ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name', 'text')
            ->add('posterImage', 'file')
            ->add('quality', 'text')
            ->add('size', 'text')
            ->add('runtime', 'text')
            ->add('language', 'text')
            ->add('releaseDate', 'date')
            ->add('directors', 'textarea')
            ->add('writers', 'textarea')
            ->add('cast', 'textarea')
            ->add('description', 'textarea')
            ->add('imdbRating', 'number')
            ->add('magnetLink', 'text')
            ->add('torrentFile', 'file')
            ->add('torrentFileName', 'text')
            ->add('youtubeLink', 'text')
            ->add('imdbLink', 'text')
            ->add('posterName', 'text')
            ->add('updatedAt', 'datetime')
            ->add('genres', 'entity', [
                'class' => 'AppBundle\Entity\Genre',
                'choice_label' => 'name',
                'placeholder' => '---',
                'multiple' => true,
                'required' => false,
                'choices' => $this->getModelManager()->findBy(Genre::class),
            ]);
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
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
            ->add('updatedAt')
        ;
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
