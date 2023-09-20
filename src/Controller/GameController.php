<?php

namespace App\Controller;

use App\Entity\Deck;
use App\Entity\Cards;
use App\Entity\Hands;
use App\View\ConsoleView;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/', name: 'app_')]
class GameController extends AbstractController
{
    #[Route('/game', name: 'game')]
    public function index(): Response
    {
        return $this->render('game/index.html.twig', [
            'controller_name' => 'GameController',
        ]);
    }

    #[Route('game/{nbCards}', name: 'game_card')]
    public function game(Request $request, $nbCards)
    {
        $deck = new Deck();
        $hand = new Hands([]);
        // Récupérer le nombre de cartes à piocher depuis la requête ou depuis le paramètre de route
        $nbCards = $request->query->get('nbCards') ?? $nbCards;

        // Piocher le nombre de cartes demandé
        try {
            $hand = $deck->draw($nbCards);
        } catch (\Exception $e) {
            // Gérer l'erreur en cas de nombre de cartes demandé supérieur au nombre de cartes dans le deck
            return new Response($e->getMessage(), Response::HTTP_BAD_REQUEST);
        }

        // Trier la main
        $hand->sort($deck->getValues(), $deck->getColors());

        // Afficher la main dans la console
        $view = new ConsoleView();
        $view->display($hand, $deck);

        return new Response();
    }

    #[Route('/', name: 'choice')]
    public function choice(Request $request):Response
    {
        $formData = $request->request->all();
        if ($formData) {
            $nbCards = $formData['num_cards'];
            return $this->redirectToRoute('app_game_card', ['nbCards' => $nbCards]);
        }
        return $this->render('game/index.html.twig');
    }
}
