<?php

namespace App\Controller;
use App\Repository\HabitatRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HabitatController extends AbstractController
{
    #[Route('/habitat', name: 'app_habitat')]
    public function index(HabitatRepository $habitatRepository): Response
    {

        $habitats = $habitatRepository->findAll();

        return $this->render('habitat/index.html.twig', [
            'habitats' => $habitats,
        ]);
    }
}
