<?php

namespace App\Controller\Admin;

use App\Entity\Navigation;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class NavigationCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Navigation::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name'),
            IntegerField::new('sort_order', 'Sort Order'),
            $type = ChoiceField::new('type')
                ->setChoices([
                    'Label' => 'label',
                    'Nav' => 'nav',
                ]),
            TextField::new('route'),
            TextField::new('url'),
        ];
    }

    /**
     * @param Crud $crud
     * @return Crud
     */
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setDefaultSort(['name' => 'ASC'])
            ->setPaginatorPageSize(15);
    }
}
