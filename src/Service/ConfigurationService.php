<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Configuration;

class ConfigurationService
{
    public function __construct(
        private EntityManagerInterface $entityManager
    ) {}

    public function getConfiguration(): ?Configuration
    {
        return $this->entityManager->getRepository(Configuration::class)->findConfiguration();
    }
}
