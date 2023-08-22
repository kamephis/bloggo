<?php

namespace App\Entity;

use App\Repository\PageRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Cmf\Component\Routing\RouteObjectInterface;

#[ORM\Entity(repositoryClass: PageRepository::class)]
#[UniqueEntity("routeKey")]
class Page implements RouteObjectInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(inversedBy: "page", targetEntity: Route::class, cascade: ["persist", "remove"])]
    private ?Route $route = null;

    #[ORM\Column(type: "string", length: 255, unique: true)]
    private ?string $routeKey = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $title = null;

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

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): static
    {
        $this->title = $title;

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

    public function getContent(): self
    {
        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRouteKey(): ?string
    {
        return $this->routeKey;
    }

    public function setRouteKey(?string $routeKey): void
    {
        $this->routeKey = $routeKey;
    }

    public function getRoute(): ?Route
    {
        return $this->route;
    }

    public function setRoute(?Route $route): self
    {
        $this->route = $route;

        // set (or unset) the owning side of the relation
        $newPage = null === $route ? null : $this;
        if ($route->getPage() !== $newPage) {
            $route->setPage($newPage);
        }

        return $this;
    }
    private ?string $routeName = null;

    public function getRouteName(): ?string
    {
        return $this->routeName;
    }

    public function setRouteName(?string $routeName): self
    {
        $this->routeName = $routeName;
        return $this;
    }

}
