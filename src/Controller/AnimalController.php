<?php

namespace App\Controller;
use App\Repository\AnimalRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class AnimalController extends AbstractController
{
    #[Route('/animal', name: 'app_animal')]
    public function index(AnimalRepository $animalRepository): Response
    {
        $animaux = $animalRepository->findAll();

        return $this->render('animal/index.html.twig', [
            'animaux' => $animaux,
        ]);
    }
}
