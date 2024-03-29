<?php

namespace App\Entity;

use App\Repository\FavoriteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FavoriteRepository::class)]
class Favorite
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $type = null;

    #[ORM\Column(length: 255)]
    private ?string $country = null;

    #[ORM\Column(length: 64, nullable: true)]
    private ?string $year = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $format = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $genre = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $label = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $url = null;

    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: 'favorites')]
    private ?Collection $users;

    #[ORM\Column(length: 512, nullable: true)]
    private ?string $cover;

    #[ORM\Column(length: 512, nullable: true)]
    private ?string $ressourceUrl;

    public function __construct()
    {
        $this->users = new ArrayCollection();
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

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): static
    {
        $this->country = $country;

        return $this;
    }


    public function getGenre(): ?string
    {
        return $this->genre;
    }

    public function setGenre(?string $genre): static
    {
        $this->genre = $genre;

        return $this;
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    public function setLabel(?string $label): void
    {
        $this->label = $label;
    }


    public function getUsers(): ArrayCollection|Collection
    {
        return $this->users;
    }

    public function addUser(?User $user): void
    {
        $this->users->add($user);
    }

    public function removeUser(?User $user): void
    {
        $this->users->removeElement($user);
    }

    public function getCover(): ?string
    {
        return $this->cover;
    }

    public function setCover(?string $cover): void
    {
        $this->cover = $cover;
    }

    public function geturl(): ?string
    {
        return $this->url;
    }

    public function seturl(?string $url): void
    {
        $this->url = $url;
    }

    public function getYear(): ?string
    {
        return $this->year;
    }

    public function setYear(?string $year): void
    {
        $this->year = $year;
    }

    public function getFormat(): ?string
    {
        return $this->format;
    }

    public function setFormat(?string $format): void
    {
        $this->format = $format;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): void
    {
        $this->type = $type;
    }

    public function getRessourceUrl(): ?string
    {
        return $this->ressourceUrl;
    }

    public function setRessourceUrl(?string $ressourceUrl): void
    {
        $this->ressourceUrl = $ressourceUrl;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'type' => $this->type,
            'country' => $this->country,
            'year' => $this->year,
            'format' => $this->format,
            'genre' => $this->genre,
            'label' => $this->label,
            'url' => $this->url,
            'cover' => $this->cover,
            'ressourceUrl' => $this->ressourceUrl,
        ];
    }

}
