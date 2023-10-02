<?php

namespace App\Entity;

use App\Repository\GenderListRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GenderListRepository::class)]
class GenderList
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $genderValue = null;

    #[ORM\OneToMany(mappedBy: 'gender', targetEntity: Candidate::class)]
    private Collection $candidates;

    public function __construct()
    {
        $this->candidates = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGenderValue(): ?string
    {
        return $this->genderValue;
    }

    public function setGenderValue(string $genderValue): static
    {
        $this->genderValue = $genderValue;

        return $this;
    }

    /**
     * @return Collection<int, Candidate>
     */
    public function getCandidates(): Collection
    {
        return $this->candidates;
    }

    public function addCandidate(Candidate $candidate): static
    {
        if (!$this->candidates->contains($candidate)) {
            $this->candidates->add($candidate);
            $candidate->setGender($this);
        }

        return $this;
    }

    public function removeCandidate(Candidate $candidate): static
    {
        if ($this->candidates->removeElement($candidate)) {
            // set the owning side to null (unless already changed)
            if ($candidate->getGender() === $this) {
                $candidate->setGender(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->genderValue;
    }
}
