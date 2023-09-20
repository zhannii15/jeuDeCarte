<?php

namespace App\Entity;

use App\Repository\CardsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CardsRepository::class)]
class Cards
{
    
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $value = null;

    #[ORM\Column(length: 255)]
    private ?string $color = null;

    public function __construct(string $color, string $value)
    {
        $this->color = $color;
        $this->value = $value;
    }
    public function __toString()
    {
    // retourne une chaîne de caractères représentant la carte, par exemple "AS Trèfle"
        return $this->value . ' ' . $this->color;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function getHand(): ?Hands
    {
        return $this->hand;
    }

    public function setHand(?Hands $hand): static
    {
        $this->hand = $hand;

        return $this;
    }
  
}
