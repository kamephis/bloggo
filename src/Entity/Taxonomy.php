<?php

namespace App\Entity;

use App\Repository\TaxonomyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TaxonomyRepository::class)]
class Taxonomy
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 64)]
    private ?string $name = null;

    #[ORM\ManyToMany(targetEntity: Post::class, mappedBy: 'taxonomy')]
    private Collection $relatedPosts;

    #[ORM\Column(length: 64, nullable: true)]
    private ?string $cssClass = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $url = null;

    public function __construct()
    {
        $this->relatedPosts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Post>
     */
    public function getRelatedPosts(): Collection
    {
        return $this->relatedPosts;
    }

    public function addRelatedPost(Post $relatedPost): static
    {
        if (!$this->relatedPosts->contains($relatedPost)) {
            $this->relatedPosts->add($relatedPost);
            $relatedPost->addTaxonomy($this);
        }

        return $this;
    }

    public function removeRelatedPost(Post $relatedPost): static
    {
        if ($this->relatedPosts->removeElement($relatedPost)) {
            $relatedPost->removeTaxonomy($this);
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->name;
    }

    public function getCssClass(): ?string
    {
        return $this->cssClass;
    }

    public function setCssClass(?string $cssClass): static
    {
        $this->cssClass = $cssClass;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(?string $url): static
    {
        $this->url = $url;

        return $this;
    }
}
