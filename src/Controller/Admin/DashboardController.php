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
use App\Repository\ApplicationRepository;
use App\Repository\CandidateRepository;
use App\Repository\ContactRepository;
use App\Repository\CustomerRepository;
use App\Repository\JobOfferRepository;
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
        private ContactRepository $contactRepository,
        private ApplicationRepository $applicationRepository,
        private CustomerRepository $customerRepository,
        private CandidateRepository $candidateRepository,
        private JobOfferRepository $jobOfferRepository,

    ) {
    }

    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $messagesChart = $this->chartBuilder->createChart(Chart::TYPE_PIE);

        $messagesChart->setData([
            'labels' => ['Processed', 'Pending', 'Declined'],
            'datasets' => [
                [
                    'color' => 'rgb(181, 181, 181)',
                    'borderColor' => 'rgb(181, 181, 181)',
                    'backgroundColor' => ['rgb(139, 191, 124)', 'rgb(111, 191, 241)', 'rgb(255, 148, 155)'],
                    'hoverOffset' => '3',
                    'label' => 'Messages',
                    'data' => [
                        count($this->contactRepository->findContactByContactStatusValue('Processed')),
                        count($this->contactRepository->findContactByContactStatusValue('Pending')),
                        count($this->contactRepository->findContactByContactStatusValue('Declined'))
                    ],
                ],
            ],
        ]);


        $messagesChart->setOptions([
            'plugins' => [
                'title' => [
                    'display' => true,
                    'text' => 'Messages'
                ]
            ]
        ]);


        $applicationsChart = $this->chartBuilder->createChart(Chart::TYPE_PIE);

        $applicationsChart->setData([
            'labels' => ['Accepted', 'Pending', 'Declined'],
            'datasets' => [
                [
                    'color' => 'rgb(181, 181, 181)',
                    'borderColor' => 'rgb(181, 181, 181)',
                    'backgroundColor' => ['rgb(139, 191, 124)', 'rgb(111, 191, 241)', 'rgb(255, 148, 155)'],
                    'label' => 'Applications',
                    'hoverOffset' => '3',
                    'data' => [
                        count($this->applicationRepository->findContactByApplicationStatusValue('Accepted')),
                        count($this->applicationRepository->findContactByApplicationStatusValue('Pending')),
                        count($this->applicationRepository->findContactByApplicationStatusValue('Declined'))
                    ],
                ],
            ],
        ]);

        $applicationsChart->setOptions([
            'plugins' => [
                'title' => [
                    'display' => true,
                    'text' => 'Applications'
                ]
            ]
        ]);




        $mixedChart = $this->chartBuilder->createChart(Chart::TYPE_BAR);

        $mixedChart->setData([
            'labels' => ['Job Offers', 'Customers', 'Candidates'],
            'datasets' => [
                [
                    'borderColor' => ['rgb(139, 191, 124)', 'rgb(111, 191, 241)', 'rgb(255, 148, 155)'],
                    'backgroundColor' => ['rgb(139, 191, 124, 0.5)', 'rgb(111, 191, 241, 0.5)', 'rgb(255, 148, 155, 0.5)'],
                    'label' => 'Quantity',
                    'borderWidth' => 2,
                    'data' => [
                        count($this->jobOfferRepository->findAll()),
                        count($this->customerRepository->findAll()),
                        count($this->candidateRepository->findAll())
                    ],
                ],
            ],
        ]);

        $mixedChart->setOptions([
            'plugins' => [
                'title' => [
                    'display' => true,
                    'text' => 'Job Offers | Customers | Candidates'
                ],
                'legend' => [
                    'display' => false

                ]
            ],
            'aspectRatio' => '1'
        ]);




        return $this->render('admin/dashboard.html.twig', [
            'messagesChart' => $messagesChart,
            'applicationsChart' => $applicationsChart,
            'mixedChart' => $mixedChart,
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
