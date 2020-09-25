<?php

namespace App\Controller;

use App\Repository\GamesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class GameController extends AbstractController
{
    /**
     * @Route("/game", name="game")
     * @param GamesRepository $gamesRepository
     * @return JsonResponse
     */
    public function index(GamesRepository $gamesRepository)
    {
        $games = $gamesRepository->findAll();
//        dump($games);
        return $this->json($games);
    }
}
