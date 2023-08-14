<?php

namespace App\Controller\Admin;

use App\Entity\Navigation;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Routing\RouterInterface;

class NavigationCrudController extends AbstractCrudController
{
    private RouterInterface $router;

    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    public static function getEntityFqcn(): string
    {
        return Navigation::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name'),
            IntegerField::new('sort_order', 'Sort Order'),
            ChoiceField::new('type')
                ->setChoices([
                    'Nav' => 'nav',
                    'Label' => 'label',
                ]),
            ChoiceField::new('route')->setChoices($this->getAvailableRoutes()),
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

    private function getAvailableRoutes(): array
    {
        $allRoutes = $this->router->getRouteCollection()->all();
        $availableRoutes = [];

        foreach ($allRoutes as $routeName => $route) {
            if (str_starts_with($routeName, '_')) { // Exclude routes starting with underscore
                continue;
            }
            $availableRoutes[$routeName] = $routeName;
        }

        return $availableRoutes;
    }
}
