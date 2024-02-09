<?php

namespace App\Entity;

use App\Repository\FruitRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FruitRepository::class)]
class Fruit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::SIMPLE_ARRAY, length: 255, nullable: true)]
    private ?array $season;

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

    public function getSeason(): ?array
    {
        return $this->season;
    }

    public function setSeason(?array $season): static
    {
        $this->season = $season;

        return $this;
    }
}
