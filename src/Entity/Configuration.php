<?php

namespace App\Entity;

use App\Repository\ConfigurationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ConfigurationRepository::class)]
class Configuration
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $siteName = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $siteEmail = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $siteOwnerFirstName = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $siteOwnerLastName = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $siteLogo = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSiteName(): ?string
    {
        return $this->siteName;
    }

    public function setSiteName(?string $siteName): static
    {
        $this->siteName = $siteName;

        return $this;
    }

    public function getSiteEmail(): ?string
    {
        return $this->siteEmail;
    }

    public function setSiteEmail(?string $siteEmail): static
    {
        $this->siteEmail = $siteEmail;

        return $this;
    }

    public function getSiteOwnerFirstName(): ?string
    {
        return $this->siteOwnerFirstName;
    }

    public function setSiteOwnerFirstName(?string $siteOwnerFirstName): static
    {
        $this->siteOwnerFirstName = $siteOwnerFirstName;

        return $this;
    }

    public function getSiteOwnerLastName(): ?string
    {
        return $this->siteOwnerLastName;
    }

    public function setSiteOwnerLastName(?string $siteOwnerLastName): static
    {
        $this->siteOwnerLastName = $siteOwnerLastName;

        return $this;
    }

    public function getSiteLogo(): ?string
    {
        return $this->siteLogo;
    }

    public function setSiteLogo(?string $siteLogo): static
    {
        $this->siteLogo = $siteLogo;

        return $this;
    }
}
