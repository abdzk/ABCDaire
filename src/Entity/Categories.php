<?php

namespace App\Entity;

use App\Repository\CategoriesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoriesRepository::class)]
class Categories
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $name = null;

    #[ORM\ManyToMany(targetEntity: ABCD::class, mappedBy: 'categories')]
    private Collection $aBCDs;

    public function __construct()
    {
        $this->aBCDs = new ArrayCollection();
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

    /**
     * @return Collection<int, ABCD>
     */
    public function getABCDs(): Collection
    {
        return $this->aBCDs;
    }

    public function addABCD(ABCD $aBCD): self
    {
        if (!$this->aBCDs->contains($aBCD)) {
            $this->aBCDs->add($aBCD);
            $aBCD->addCategory($this);
        }

        return $this;
    }

    public function removeABCD(ABCD $aBCD): self
    {
        if ($this->aBCDs->removeElement($aBCD)) {
            $aBCD->removeCategory($this);
        }

        return $this;
    }


}
