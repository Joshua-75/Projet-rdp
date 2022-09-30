<?php

namespace App\Controller\Admin;

use App\Entity\Depanneur;
use App\Entity\Prestataire;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use App\Controller\Admin\PrestataireCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    public function __construct(private AdminUrlGenerator $adminUrlGenerator)
    {
    }
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $url = $this->adminUrlGenerator->setController(PrestataireCrudController::class)->generateUrl();
        $dminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        return $this->redirect($url);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Rdp');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::section('Prestataire');
        yield MenuItem::subMenu('Prestataire', 'fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Ajout de prestataire', 'fas fa-plus', Prestataire::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Afficher les prestataires', 'fas fa-eye', Prestataire::class)
        ]);
        yield MenuItem::section('Depannnage');
        yield MenuItem::subMenu('Dépanneur', 'fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Ajout de dépanneur', 'fas fa-plus', Depanneur::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Afficher les dépanneurs', 'fas fa-eye', Depanneur::class)
        ]);
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
    }
}
