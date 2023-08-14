<?php

namespace App\Service;

use App\Entity\Navigation;
use Doctrine\ORM\EntityManagerInterface;

class NavbarTaxonomies
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function getNavTaxonomies(): array
    {
        return $this->em->getRepository(Navigation::class)->findBy(['type' => 'nav'], ['sortOrder' => 'ASC']);
    }
}
