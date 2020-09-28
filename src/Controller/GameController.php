<?php

namespace App\Controller;

use App\Repository\GamesRepository;
use App\Repository\CommentsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class GameController extends AbstractController
{
    /**
     * @Route("/gameList", name="gameList")
     * @param GamesRepository $gamesRepository
     * @return JsonResponse
     */
    public function index(GamesRepository $gamesRepository)
    {
        $games = $gamesRepository->findAll();
//        dump($games);
        return $this->json($games);
    }

    /**
     * @Route("/comment/{id}", name="commentRemove", methods={"DELETE"})
     * @return JsonResponse
     *
     */
    public function indexx(CommentsRepository $commentsRepository, $id, EntityManagerInterface $entityManager)
    {
        $comment = $commentsRepository->find($id);
//        dd($comment);
        $entityManager->remove($comment);
        $entityManager->flush();
        return $this->json($comment);
    }
    //
    //    Syntaxe 2 plus condensée
    //

}
