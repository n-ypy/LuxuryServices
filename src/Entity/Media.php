<?php

namespace App\Entity;

use App\Repository\MediaRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MediaRepository::class)]
class Media
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $url = null;

    #[ORM\OneToOne(mappedBy: 'passportFile', cascade: ['persist', 'remove'])]
    private ?Candidate $candidatePassportFile = null;

    #[ORM\OneToOne(mappedBy: 'curriculumVitae', cascade: ['persist', 'remove'])]
    private ?Candidate $candidateCurriculumVitae = null;

    #[ORM\OneToOne(mappedBy: 'profilePicture', cascade: ['persist', 'remove'])]
    private ?Candidate $candidateProfilePicture = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): static
    {
        $this->url = $url;

        return $this;
    }

    public function getCandidatePassportFile(): ?Candidate
    {
        return $this->candidatePassportFile;
    }

    public function setCandidatePassportFile(?Candidate $candidatePassportFile): static
    {
        // unset the owning side of the relation if necessary
        if ($candidatePassportFile === null && $this->candidatePassportFile !== null) {
            $this->candidatePassportFile->setPassportFile(null);
        }

        // set the owning side of the relation if necessary
        if ($candidatePassportFile !== null && $candidatePassportFile->getPassportFile() !== $this) {
            $candidatePassportFile->setPassportFile($this);
        }

        $this->candidatePassportFile = $candidatePassportFile;

        return $this;
    }

    public function getCandidateCurriculumVitae(): ?Candidate
    {
        return $this->candidateCurriculumVitae;
    }

    public function setCandidateCurriculumVitae(?Candidate $candidateCurriculumVitae): static
    {
        // unset the owning side of the relation if necessary
        if ($candidateCurriculumVitae === null && $this->candidateCurriculumVitae !== null) {
            $this->candidateCurriculumVitae->setPassportFile(null);
        }

        // set the owning side of the relation if necessary
        if ($candidateCurriculumVitae !== null && $candidateCurriculumVitae->getPassportFile() !== $this) {
            $candidateCurriculumVitae->setPassportFile($this);
        }

        $this->candidateCurriculumVitae = $candidateCurriculumVitae;

        return $this;
    }

    public function getCandidateProfilePicture(): ?Candidate
    {
        return $this->candidateProfilePicture;
    }

    public function setCandidateProfilePicture(?Candidate $candidateProfilePicture): static
    {
        // unset the owning side of the relation if necessary
        if ($candidateProfilePicture === null && $this->candidateProfilePicture !== null) {
            $this->candidateProfilePicture->setPassportFile(null);
        }

        // set the owning side of the relation if necessary
        if ($candidateProfilePicture !== null && $candidateProfilePicture->getPassportFile() !== $this) {
            $candidateProfilePicture->setPassportFile($this);
        }

        $this->candidateProfilePicture = $candidateProfilePicture;

        return $this;
    }
    
    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeImmutable $createdAt = null): static
    {
        $this->createdAt ??= $createdAt ?? new \DateTimeImmutable();

        return $this;
    }

    public function __toString(): string
    {
        return $this->url;
    }

}
