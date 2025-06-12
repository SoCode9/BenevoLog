<?php

namespace App\Entity;

use App\Repository\EmergencyContactRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EmergencyContactRepository::class)]
class EmergencyContact
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 128, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(length: 32, nullable: true)]
    private ?string $relationship = null;

    #[ORM\Column(length: 16, nullable: true)]
    private ?string $phone_number = null;

    #[ORM\OneToOne(inversedBy: 'emergencyContact', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Benevol $benevol = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getRelationship(): ?string
    {
        return $this->relationship;
    }

    public function setRelationship(?string $relationship): static
    {
        $this->relationship = $relationship;

        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phone_number;
    }

    public function setPhoneNumber(?string $phone_number): static
    {
        $this->phone_number = $phone_number;

        return $this;
    }

    public function getBenevol(): ?Benevol
    {
        return $this->benevol;
    }

    public function setBenevol(Benevol $benevol): static
    {
        $this->benevol = $benevol;

        return $this;
    }
}
