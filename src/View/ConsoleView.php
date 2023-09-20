<?php

namespace App\View;

use App\Entity\Cards;
use App\Entity\Hands;
use App\Entity\Deck;

class ConsoleView
{
    public function __construct()
    {
    }

    public function display(Hands $hand, Deck $deck)
    {
        $valueOrder = $deck->getValues();
        $colorOrder = $deck->getColors();

        $cards = $hand->getCard();
        // echo 'Ordre des couleurs généré : ';
        // foreach ($colorOrder as $ordrecouleur) {
        //     echo $ordrecouleur. "\n";
        // }
        // echo '<br />';

        // echo 'Ordre des valeurs généré : ';
        // foreach ($valueOrder as $ordrevaleur) {
        //     echo $ordrevaleur. "\n";
        // }

        echo '<br />';

        echo 'Nombre de cartes demandé : '.count($cards) . " \n";

        echo "<br />";

        // Affichage de la main "non triée" dans la console
        echo "Main non triée :\n";
        foreach ($cards as $card) {
            
            echo $card->getColor() . ' ' . $card->getValue()." / ";
        }
        

        echo "<br />";

        // Tri de la main selon l'ordre aléatoire des couleurs et des valeurs
        usort($cards, function (Cards $a, Cards $b) use ($valueOrder, $colorOrder) {

            $aColorIndex = array_search($a->getColor(), $colorOrder);
            $bColorIndex = array_search($b->getColor(), $colorOrder);

            if ($aColorIndex !== $bColorIndex) {
                return ($aColorIndex > $bColorIndex);
            } else {
                $aValueIndex = array_search($a->getValue(), $valueOrder);
                $bValueIndex = array_search($b->getValue(), $valueOrder);
                return ($aValueIndex > $bValueIndex);
            }
        });

        // Affichage de la main triée dans la console
        echo "\nMain triée :\n";
        foreach ($cards as $card) {
            echo $card->getValue() . $card->getColor() . "/";
        }

        echo "<br />";
        echo "<br />";
        echo "<a role='button' type='button' href='/game/".count($cards)."'>Re-piocher</a>";

        echo "<br />";
        echo "<br />";
        echo "<a role='button' type='button' href='/'>Revenir au menu </a>";
        
    }
}