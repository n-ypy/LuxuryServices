<?php

namespace App\Entity;

use App\Repository\AdminNotesRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AdminNotesRepository::class)]
class AdminNotes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $content = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\OneToOne(mappedBy: 'notes', cascade: ['persist', 'remove'])]
    private ?Customer $customer = null;

    #[ORM\OneToOne(mappedBy: 'notes', cascade: ['persist', 'remove'])]
    private ?JobOffer $jobOffer = null;

    #[ORM\OneToOne(mappedBy: 'notes', cascade: ['persist', 'remove'])]
    private ?Candidate $candidate = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): static
    {
        $this->content = $content;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

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

    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    public function setCustomer(?Customer $customer): static
    {
        // unset the owning side of the relation if necessary
        if ($customer === null && $this->customer !== null) {
            $this->customer->setNotes(null);
        }

        // set the owning side of the relation if necessary
        if ($customer !== null && $customer->getNotes() !== $this) {
            $customer->setNotes($this);
        }

        $this->customer = $customer;

        return $this;
    }

    public function getJobOffer(): ?JobOffer
    {
        return $this->jobOffer;
    }

    public function setJobOffer(?JobOffer $jobOffer): static
    {
        // unset the owning side of the relation if necessary
        if ($jobOffer === null && $this->jobOffer !== null) {
            $this->jobOffer->setNotes(null);
        }

        // set the owning side of the relation if necessary
        if ($jobOffer !== null && $jobOffer->getNotes() !== $this) {
            $jobOffer->setNotes($this);
        }

        $this->jobOffer = $jobOffer;

        return $this;
    }

    public function getCandidate(): ?Candidate
    {
        return $this->candidate;
    }

    public function setCandidate(?Candidate $candidate): static
    {
        // unset the owning side of the relation if necessary
        if ($candidate === null && $this->candidate !== null) {
            $this->candidate->setNotes(null);
        }

        // set the owning side of the relation if necessary
        if ($candidate !== null && $candidate->getNotes() !== $this) {
            $candidate->setNotes($this);
        }

        $this->candidate = $candidate;

        return $this;
    }

    public function __toString()
    {
        return $this->content;
    }
}
