<?php

namespace App\Entity;

use App\Repository\PageRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Cmf\Bundle\RoutingBundle\Doctrine\Orm\Route as BaseRoute;


#[ORM\Entity(repositoryClass: PageRepository::class)]
#[UniqueEntity("route")]
class Page
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $title = null;

    #[ORM\Column(length: 64)]
    private ?string $identifier = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $summary = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $createdAt = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $updatedAt = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $cmsContent = null;

    #[ORM\Column(nullable: true)]
    private ?bool $published = null;

    #[ORM\Column(type: "string", length: 255)]
    private ?string $route = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getIdentifier(): ?string
    {
        return $this->identifier;
    }

    public function setIdentifier(string $identifier): static
    {
        $this->identifier = $identifier;

        return $this;
    }

    public function getSummary(): ?string
    {
        return $this->summary;
    }

    public function setSummary(?string $summary): static
    {
        $this->summary = $summary;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getCmsContent(): ?string
    {
        return $this->cmsContent;
    }

    public function setCmsContent(?string $cmsContent): static
    {
        $this->cmsContent = $cmsContent;

        return $this;
    }

    public function isPublished(): ?bool
    {
        return $this->published;
    }

    public function setPublished(?bool $published): static
    {
        $this->published = $published;

        return $this;
    }

    public function getRoute(): ?string
    {
        return $this->route;
    }

    public function setRoute(?string $route): static
    {
        $this->route = $route;

        return $this;
    }

    public function getRouteKey(): string
    {
        return $this->route;
    }

    public function getContent(): self
    {
        return $this;
    }
}
