<?php

namespace App\Controller;

use App\Repository\HabitatRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HabitatController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(HabitatRepository $habitatRepository): Response
    {
        $habitats = $habitatRepository->findAll();

        return $this->render('home/index.html.twig', [
            'habitats' => $habitats,
        ]);
    }

    #[Route('/habitat/{nom}', name: 'habitat_animaux')]
public function show(string $nom, HabitatRepository $habitatRepository): Response
{
    $habitat = $habitatRepository->findOneBy(['nom' => $nom]);

    if (!$habitat) {
        throw $this->createNotFoundException("Habitat \"$nom\" introuvable.");
    }

    return $this->render('animal/animal.html.twig', [
        'habitat' => $habitat,
        'animaux' => $habitat->getAnimaux(), // à condition que cette relation existe
    ]);
}

}
