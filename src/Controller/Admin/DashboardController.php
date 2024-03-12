<?php

namespace App\Controller\Admin;

use App\Entity\Apply;
use App\Entity\Candidate;
use App\Entity\Client;
use App\Entity\Experience;
use App\Entity\Files;
use App\Entity\Gender;
use App\Entity\JobCategory;
use App\Entity\JobOffer;
use App\Entity\JobType;
use App\Entity\Status;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        // return parent::index();

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        return $this->render('admin/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Luxury Services');
  
            
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Client Manager', 'fas fa-list', Client::class);
        yield MenuItem::linkToCrud('Candidate Manager', 'fas fa-list', Candidate::class);
        yield MenuItem::linkToCrud('Status Manager', 'fas fa-list', Status::class);
        yield MenuItem::linkToCrud('Gender Manager', 'fas fa-list', Gender::class);
        yield MenuItem::linkToCrud('Experience Manager', 'fas fa-list', Experience::class);
        yield MenuItem::linkToCrud('JobType Manager', 'fas fa-list', JobType::class);
        yield MenuItem::linkToCrud('JobCategory Manager', 'fas fa-list', JobCategory::class);
        yield MenuItem::linkToCrud('Files Manager', 'fas fa-list', Files::class);
        yield MenuItem::linkToCrud('Apply Manager', 'fas fa-list', Apply::class);
        yield MenuItem::linkToCrud('JobOffer Manager', 'fas fa-list', JobOffer::class);
    }
}
