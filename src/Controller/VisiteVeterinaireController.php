<?php

namespace App\Controller;
use App\Repository\VisiteVeterinaireRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class VisiteVeterinaireController extends AbstractController
{
    #[Route('/veterinaire', name: 'app_visite_veterinaire')]
    public function index(VisiteVeterinaireRepository $visiteVeterinaireRepository): Response
    {
        return $this->render('visite_veterinaire/index.html.twig', [
            'visiteVeterinaires' => $visiteVeterinaireRepository->findAll(),
        ]);
    }
}
