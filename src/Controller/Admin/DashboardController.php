<?php

namespace App\Controller\Admin;

use App\Controller\Admin\AdminNotesCrudController;
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
use App\Repository\ContactRepository;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;

class DashboardController extends AbstractDashboardController
{

    public function __construct(
        private AdminUrlGenerator $adminUrlGenerator,
        private ChartBuilderInterface $chartBuilder,
        private ContactRepository $contactRepository
    ) {
    }

    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $chart = $this->chartBuilder->createChart(Chart::TYPE_PIE);
        $chart->setData([

            'datasets' => [
                'labels' => ['Processed', 'Pending', 'Declined'],
                [
                    'label' => 'Messages',
                    'backgroundColor' => 'rgb(255, 99, 132)',
                    'data' => [
                        $this->contactRepository->findContactByContactStatusValue('Processed'), 
                        $this->contactRepository->findContactByContactStatusValue('Pending'), 
                        $this->contactRepository->findContactByContactStatusValue('Declined')
                        ]
                ],
            ]
        ]);


        return $this->render('admin/dashboard.html.twig', [
            'chart' => $chart,
        ]);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setFaviconPath('assets/img/ico.png')
            ->setTitle('<img src="assets/img/ico.png"> Luxury Services');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa-solid fa-gauge-high');
        yield MenuItem::section('MAIN');
        yield MenuItem::linkToCrud('Messages', 'fa-solid fa-envelope', Contact::class);
        yield MenuItem::linkToCrud('Applications', 'fa-solid fa-clipboard', Application::class);
        yield MenuItem::linkToCrud('Job offers', 'fas fa-briefcase', JobOffer::class);
        yield MenuItem::linkToCrud('Customers', 'fa-solid fa-user-tie', Customer::class);
        yield MenuItem::linkToCrud('Candidates', 'fa-solid fa-poo', Candidate::class);
        yield MenuItem::section('MISC');
        yield MenuItem::linkToCrud('Users', 'fa-solid fa-user', User::class);
        yield MenuItem::linkToCrud('Notes', 'fa-solid fa-note-sticky', AdminNotes::class)->setController(AdminNotesCrudController::class);
        yield MenuItem::linkToCrud('Medias', 'fas fa-floppy-disk', Media::class);
        yield MenuItem::subMenu('Select Menu Items', 'fa-solid fa-tags')->setSubItems([
            MenuItem::linkToCrud('Application Status', 'fa-solid fa-tag', ApplicationStatus::class),
            MenuItem::linkToCrud('Contact Status', 'fa-solid fa-tag', ContactStatus::class),
            MenuItem::linkToCrud('Experience', 'fa-solid fa-tag', Experience::class),
            MenuItem::linkToCrud('Genders', 'fa-solid fa-tag', GenderList::class),
            MenuItem::linkToCrud('Job Categories', 'fa-solid fa-tag', JobCategory::class),
            MenuItem::linkToCrud('Job Types', 'fa-solid fa-tag', JobType::class),
        ]);
    }
}
