<?php

namespace App\Controller\Admin;

use App\Entity\AdminNotes;
use App\Entity\Application;
use App\Entity\ApplicationStatus;
use App\Entity\Candidate;
use App\Entity\Contact;
use App\Entity\ContactStatus;
use App\Entity\Customer;
use App\Entity\Experience;
use App\Entity\GenderList;
use App\Entity\JobCategory;
use App\Entity\JobOffer;
use App\Entity\JobType;
use App\Entity\Media;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{

    public function __construct(private AdminUrlGenerator $adminUrlGenerator) 
    {
    }
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {

        $url = $this->adminUrlGenerator
        ->setController(AdminNotesCrudController::class)
        ->generateUrl();

        return $this->redirect($url);
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
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
        ->setFaviconPath('assets/img/ico.png')
        ->setTitle('Luxury Services');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Notes', 'fa-solid fa-note-sticky', AdminNotes::class);
        yield MenuItem::linkToCrud('Application', 'fa-solid fa-clipboard', Application::class);
        yield MenuItem::linkToCrud('Candidate', 'fa-solid fa-poo', Candidate::class);
        yield MenuItem::linkToCrud('Contact', 'fa-solid fa-envelope', Contact::class);
        yield MenuItem::linkToCrud('Customer', 'fa-solid fa-user-tie', Customer::class);
        yield MenuItem::linkToCrud('Job Offer', 'fas fa-briefcase', JobOffer::class);
        yield MenuItem::linkToCrud('Media', 'fas fa-floppy-disk', Media::class);
        yield MenuItem::linkToCrud('User', 'fa-solid fa-user', User::class);

        yield MenuItem::subMenu('Select Menu Items', 'fa-solid fa-tags')->setSubItems([
            MenuItem::linkToCrud('Application Status', 'fa-solid fa-tag', ApplicationStatus::class),
            MenuItem::linkToCrud('Contact Status', 'fa-solid fa-tag', ContactStatus::class),
            MenuItem::linkToCrud('Experience', 'fa-solid fa-tag', Experience::class),
            MenuItem::linkToCrud('Gender List', 'fa-solid fa-tag', GenderList::class),
            MenuItem::linkToCrud('Job Category', 'fa-solid fa-tag', JobCategory::class),
            MenuItem::linkToCrud('Job Type', 'fa-solid fa-tag', JobType::class),
        ]);

        
    }
}
