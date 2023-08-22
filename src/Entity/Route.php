<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Cmf\Component\Routing\RouteObjectInterface;

#[ORM\Entity]
#[ORM\Table(name: "orm_routes")]
class Route implements RouteObjectInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private int $id;

    #[ORM\Column(type: "string", length: 255, unique: true)]
    private string $path;

    #[ORM\Column(type: "integer", nullable: true)]
    private ?int $position = null;

    #[ORM\OneToOne(mappedBy: "route", targetEntity: Page::class, cascade: ["persist", "remove"])]
    private ?Page $page = null;

    #[ORM\Column(type: "string", length: 255, unique: true)]
    private ?string $staticPrefix = null;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private ?string $name = null;

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getPosition(): ?int
    {
        return $this->position;
    }

    public function setPosition(?int $position): self
    {
        $this->position = $position;
        return $this;
    }

    public function getStaticPrefix(): ?string
    {
        return $this->staticPrefix;
    }

    public function setStaticPrefix(?string $staticPrefix): self
    {
        $this->staticPrefix = $staticPrefix;
        return $this;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function setPath(string $path): self
    {
        $this->path = $path;
        return $this;
    }

    public function getPage(): ?Page
    {
        return $this->page;
    }

    public function setPage(?Page $page): self
    {
        // unset the owning side of the relation if necessary
        if ($page === null && $this->page !== null) {
            $this->page->setRoute(null);
        }

        // set the owning side of the relation if necessary
        if ($page !== null && $page->getRoute() !== $this) {
            $page->setRoute($this);
        }

        $this->page = $page;

        return $this;
    }

    public function getRouteKey(): string
    {
        return $this->path;
    }

    public function getContent(): ?Page
    {
        return $this->getPage();
    }
}
