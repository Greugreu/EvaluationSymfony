<?php

namespace App\Entity;

use App\Repository\MovieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MovieRepository::class)
 */
class Movie
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     */
    private $year;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="Movies")
     */
    private $Categories;

    /**
     * @ORM\ManyToMany(targetEntity=Actor::class, inversedBy="movies")
     */
    private $Actors;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    public function __construct()
    {
        $this->Actors = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(int $year): self
    {
        $this->year = $year;

        return $this;
    }

    public function getCategories(): ?Category
    {
        return $this->Categories;
    }

    public function setCategories(?Category $Categories): self
    {
        $this->Categories = $Categories;

        return $this;
    }

    /**
     * @return Collection|Actor[]
     */
    public function getActors(): Collection
    {
        return $this->Actors;
    }

    public function addActor(Actor $actor): self
    {
        if (!$this->Actors->contains($actor)) {
            $this->Actors[] = $actor;
        }

        return $this;
    }

    public function removeActor(Actor $actor): self
    {
        $this->Actors->removeElement($actor);

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
