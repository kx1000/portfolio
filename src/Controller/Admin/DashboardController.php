<?php

namespace App\Controller\Admin;

use App\Entity\Content;
use App\Entity\File;
use App\Entity\Message;
use App\Entity\Page;
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

        return $this->redirect($routeBuilder->setController(PageCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Portfolio Sf');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToUrl('Home', 'fas fa-home', '/');
        yield MenuItem::linkToCrud('Pages', 'fas fa-sticky-note', Page::class);
        yield MenuItem::linkToCrud('Contents', 'fas fa-sticky-note', Content::class);
        yield MenuItem::linkToCrud('Projects', 'fas fa-project-diagram', Project::class);
        yield MenuItem::linkToCrud('Messages', 'fas fa-envelope', Message::class);
        yield MenuItem::linkToCrud('Files', 'far fa-image', File::class);
        yield MenuItem::linktoRoute('Change history', 'fas fa-history', 'dh_doctrine_audit_list_audits');
    }
}
