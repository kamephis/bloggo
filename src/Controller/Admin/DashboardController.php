<?php

namespace App\Controller\Admin;

use App\Entity\Configuration;
use App\Entity\CoreConfig;
use App\Entity\Navigation;
use App\Entity\Page;
use App\Entity\Taxonomy;
use App\Entity\User;
use App\Entity\Post;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return $this->render('admin/index.html.twig', []);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('<img src="/img/logo.svg" alt="Logo" style="width: 20px"> scriptive');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Posts', 'fa-solid fa-newspaper', Post::class)
            ->setController(PostCrudController::class);
        yield MenuItem::linkToCrud('Pages', 'fa-solid fa-file', Page::class)
            ->setController(PageCrudController::class);
        yield MenuItem::linkToCrud('Taxonomy', 'fa-solid fa-tag', Taxonomy::class)
            ->setController(TaxonomyCrudController::class);
        yield MenuItem::linkToCrud('Navigation', 'fa-solid fa-list', Navigation::class)
            ->setController(NavigationCrudController::class);
        yield MenuItem::subMenu('Admin', 'fa-solid fa-screwdriver-wrench')
            ->setSubItems([
                MenuItem::linkToCrud('Users', 'fa-user fa-solid fa-user', User::class)
                    ->setController(UserCrudController::class),
                MenuItem::linkToCrud('Config', 'fa-user fa-solid fa-cogs', Configuration::class)
                    ->setController(ConfigurationCrudController::class)
            ]);
    }
}
