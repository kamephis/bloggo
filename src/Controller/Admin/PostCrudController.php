<?php

namespace App\Controller\Admin;

use App\Entity\Post;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class PostCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Post::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('title'),
            AssociationField::new('taxonomy')
                ->setLabel('Tags')
                ->setFormTypeOptions([
                    'by_reference' => false, // Important for ManyToMany
                    'multiple' => true
                ]),
            TextField::new('short_description'),
            TextareaField::new('content')
                ->stripTags(),
            ImageField::new('image')
                ->setBasePath('uploads/images')
                ->setUploadDir('public/uploads/images')
                ->setUploadedFileNamePattern('[slug]-[contenthash].[extension]')
                ->setLabel('Image'),
            TextField::new('author'),
            BooleanField::new('published')
        ];
    }
    /**
     * @param Crud $crud
     * @return Crud
     */
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setDefaultSort(['title' => 'ASC'])
            ->setPaginatorPageSize(15);
    }
}
