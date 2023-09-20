<?php

namespace App\Entity;

use Exception;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\DeckRepository;

#[ORM\Entity(repositoryClass: DeckRepository::class)]
class Deck
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::ARRAY)]
    private array $cards = [];

    private $colors = ['Carreau', 'Cœur', 'Pique', 'Trèfle'];
    // private $values = ['AS', 2, 3, 4, 5, 6, 7, 8, 9, 10, 'Dame', 'Roi', 'Valet'];
    private $values = [
        1=>'As',
        2=> '2',
        3=>'3',
        4=> '4',
        5=>'5',
        6=>'6',
        7=>'7',
        8=>'8',
        9=>'9',
        10=>'10',
        11=>'Valet',
        12=>'Dame',
        13=>'Roi',

    ];
    public function __construct()
    {
        // shuffle($this->colors);
        // shuffle($this->values);

        foreach ($this->colors as $color) {
            foreach ($this->values as $value) {
                $this->cards[] = new Cards($color, $value);
            }
        }
        $this->shuffle();
    }

    public function shuffle(): void
    {
        $totalCard = count($this->cards);
        for ($i = $totalCard - 1; $i > 0; $i--) {
            $j = mt_rand(0, $i);
            $tmp = $this->cards[$i];
            $this->cards[$i] = $this->cards[$j];
            $this->cards[$j] = $tmp;
        }
    }

    public function draw(int $numCards): Hands
    {
        if ($numCards > count($this->cards)) {
            throw new Exception('Not enough cards in the deck');
        }
        $cards = array_splice($this->cards, 0, $numCards);
        return new Hands($cards);
    }

    public function getValues()
    {
        return $this->values;
    }

    public function getColors()
    {
        return $this->colors;
    }

    public function getCards(): array
    {
        return $this->cards;
    }

    public function setCards(array $cards): static
    {
        $this->cards = $cards;

        return $this;
    }
}
