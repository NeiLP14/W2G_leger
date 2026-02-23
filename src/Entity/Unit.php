<?php

namespace App\Entity;

use App\Repository\UnitRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UnitRepository::class)]
class Unit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $label = null;

    #[ORM\Column]
    private ?bool $is_occuped = null;

    #[ORM\Column]
    private ?int $position = null;

    #[ORM\ManyToOne(inversedBy: 'units')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Bay $bay = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): static
    {
        $this->label = $label;

        return $this;
    }

    public function isOccuped(): ?bool
    {
        return $this->is_occuped;
    }

    public function setIsOccuped(bool $is_occuped): static
    {
        $this->is_occuped = $is_occuped;

        return $this;
    }

    public function getPosition(): ?int
    {
        return $this->position;
    }

    public function setPosition(int $position): static
    {
        $this->position = $position;

        return $this;
    }

    public function getBay(): ?Bay
    {
        return $this->bay;
    }

    public function setBay(?Bay $bay): static
    {
        $this->bay = $bay;

        return $this;
    }
}
