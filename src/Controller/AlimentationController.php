<?php

namespace App\Controller;
use App\Repository\AlimentationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class AlimentationController extends AbstractController
{
    #[Route('/alimentation', name: 'app_alimentation')]
    public function index(AlimentationRepository $alimentationRepository): Response
    {
        return $this->render('alimentation/index.html.twig', [
            'alimentations' => $alimentationRepository->findAll(),
        ]);
    }
}
