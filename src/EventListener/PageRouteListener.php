<?php
namespace App\EventListener;

use App\Entity\Page;
use App\Entity\Route;
use Doctrine\Persistence\Event\LifecycleEventArgs;

class PageRouteListener
{
    public function prePersist(LifecycleEventArgs $args): void
    {
        $entity = $args->getObject();
        error_log('prePersist triggered for entity: ' . get_class($entity));

        if (!$entity instanceof Page) {
            return;
        }

        error_log('Handling route creation or update');
        $this->handleRouteCreationOrUpdate($entity, $args);
    }

    public function preUpdate(LifecycleEventArgs $args): void
    {
        $this->prePersist($args);
    }

    private function handleRouteCreationOrUpdate(Page $page, LifecycleEventArgs $args): void
    {
        $entityManager = $args->getObjectManager();

        // If the Page already has an associated Route, update it
        if ($route = $page->getRoute()) {
            $route->setPath($page->getRouteKey());
        } else {


            // Otherwise, create a new Route and associate it with the Page
            $route = new Route();
            $route->setPath($page->getRouteKey());
            $route->setPage($page);
            $entityManager->persist($route);
            $entityManager->flush();
            $page->setRoute($route);
        }
    }
}
