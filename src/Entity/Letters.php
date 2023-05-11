<?php

namespace App\Entity;

use App\Repository\LettersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LettersRepository::class)]
class Letters
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 1)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'letters', targetEntity: Categories::class)]
    private Collection $category;

    #[ORM\ManyToMany(targetEntity: ABCD::class, mappedBy: 'letters')]
    private Collection $aBCDs;

    public function __construct()
    {
        $this->category = new ArrayCollection();
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
     * @return Collection<int, Categories>
     */
    public function getCategory(): Collection
    {
        return $this->category;
    }

    public function addCategory(Categories $category): self
    {
        if (!$this->category->contains($category)) {
            $this->category->add($category);
            $category->setLetters($this);
        }

        return $this;
    }

    public function removeCategory(Categories $category): self
    {
        if ($this->category->removeElement($category)) {
            // set the owning side to null (unless already changed)
            if ($category->getLetters() === $this) {
                $category->setLetters(null);
            }
        }

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
            $aBCD->addLetter($this);
        }

        return $this;
    }

    public function removeABCD(ABCD $aBCD): self
    {
        if ($this->aBCDs->removeElement($aBCD)) {
            $aBCD->removeLetter($this);
        }

        return $this;
    }
}
