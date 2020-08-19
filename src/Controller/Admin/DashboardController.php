<?php

namespace App\Controller\Admin;

use App\Entity\Content;
use App\Entity\Message;
use App\Entity\Project;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\CrudUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        $routeBuilder = $this->get(CrudUrlGenerator::class)->build();

        return $this->redirect($routeBuilder->setController(ContentCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Portfolio Sf');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToCrud('Treści', 'fas fa-sticky-note', Content::class);
        yield MenuItem::linkToCrud('Projekty', 'fas fa-project-diagram', Project::class);
        yield MenuItem::linkToCrud('Wiadomości', 'fas fa-envelope', Message::class);
    }
}
