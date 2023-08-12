<?php

namespace App\Controller\Admin;

use App\Entity\Taxonomy;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class TaxonomyCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Taxonomy::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
