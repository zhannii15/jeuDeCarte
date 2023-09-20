<?php

namespace App\Entity;

use App\Repository\HandsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Deck;

#[ORM\Entity(repositoryClass: HandsRepository::class)]
class Hands
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::ARRAY)]
    private array $card = [];

    public function __construct(array $card)
    {
        $this->card = $card;
    }

    public function sort(array $colorOrder, array $valueOrder): void
    {
        usort($this->card, function (Cards $card1, Cards $card2) use ($colorOrder, $valueOrder) {
            $aColorIndex = array_search($card1->getColor(), $colorOrder);
            $bColorIndex = array_search($card2->getColor(), $colorOrder);

            if ($aColorIndex !== $bColorIndex) {
                return ($aColorIndex < $bColorIndex) ? -1 : 1;
            } else {
                $aValueIndex = array_search($card1->getValue(), $valueOrder);
                $bValueIndex = array_search($card2->getValue(), $valueOrder);
                return ($aValueIndex < $bValueIndex) ? -1 : 1;
            }
        });
    }

    public function getCard(): array
    {
        return $this->card;
    }

    public function setCard(array $card): static
    {
        $this->card = $card;

        return $this;
    }
}
