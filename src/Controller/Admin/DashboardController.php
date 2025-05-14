<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Attribute\AdminDashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\User;
use App\Entity\Animal;
use App\Entity\Habitat;
use App\Entity\VisiteVeterinaire;
use App\Entity\Alimentation;
use Symfony\Component\Routing\Annotation\Route;
use App\Controller\Admin\AlimentationCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminRouteGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
       $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);

       return $this->redirect(
        $adminUrlGenerator->setController(AnimalCrudController::class)->generateUrl()
       );
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Arcadia Zoo Admin');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Tableau de bord', 'fa fa-home');
        yield MenuItem::linkToCrud('Utilisateurs', 'fas fa-user', User::class);
        yield MenuItem::linkToCrud('Animaux', 'fas fa-dog', Animal::class);
        yield MenuItem::linkToCrud('Habitats', 'fas fa-tree', Habitat::class);
        yield MenuItem::linkToCrud('Alimentations', 'fas fa-carrot', Alimentation::class);
        yield MenuItem::linkToCrud('Visites vétérinaires', 'fas fa-stethoscope', VisiteVeterinaire::class);
        yield MenuItem::linkToUrl('Retour au site', 'fas fa-globe', '/');
        yield MenuItem::linkToLogout('Se déconnecter', 'fa fa-sign-out');

    }
}
