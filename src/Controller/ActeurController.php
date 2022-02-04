<?php

namespace App\Controller;

use App\Repository\ActeurRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ActeurController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(ActeurRepository $acteurRepository)
    {
        $listActeur = $acteurRepository->findAll();

        return $this->render('acteur/list.html.twig', [
            'acteurs' => $listActeur,
        ]);
    }
}
