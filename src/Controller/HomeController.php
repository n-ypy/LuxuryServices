<?php

namespace App\Controller;

use App\Entity\Application;
use App\Entity\Contact;
use App\Entity\JobOffer;
use App\Form\ApplicationType;
use App\Form\ContactType;
use App\Repository\ApplicationStatusRepository;
use App\Repository\ContactStatusRepository;
use App\Repository\JobOfferRepository;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(JobOfferRepository $jobOfferRepository, Request $request, EntityManagerInterface $entityManager, ApplicationStatusRepository $applicationStatusRepository,  Security $security): Response
    {
        $application = new Application();
        $form = $this->createForm(ApplicationType::class, $application);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $application->setCreatedAt(new DateTimeImmutable());
            $status = $applicationStatusRepository->findOneBy(['statusValue' => "Pending"]);
            $application->setStatus($status);
            $entityManager->persist($application);
            $entityManager->flush();

            return $this->redirectToRoute('app_application_index', [], Response::HTTP_SEE_OTHER);
        }

        $allJobs = $jobOfferRepository->findBy(['isActive' => true], limit: 10, orderBy: ["createdAt" => "DESC"]);
        return $this->render('home/index.html.twig', [
            'allJobs' => $allJobs,
            'form' => $form,
            'user' => $security->getUser(),
        ]);
    }

    #[Route('/contact', name: 'app_contact', methods: ['GET', 'POST'])]
    public function contact(Request $request, EntityManagerInterface $entityManager, ContactStatusRepository $contactStatusRepository): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $contact->setStatus($contactStatusRepository->findOneBy(['statusValue' => 'Pending']));
            $contact->setCreatedAt();
            $entityManager->persist($contact);
            $entityManager->flush();

            return $this->redirectToRoute('app_home', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('home/contact.html.twig', [
            'contact' => $contact,
            'form' => $form,
        ]);
    }

    #[Route('/company', name: 'app_company')]
    public function company(): Response
    {
        return $this->render('home/company.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/jobs', name: 'app_jobs')]
    public function jobs(JobOfferRepository $jobOfferRepository): Response
    {
        $allJobs = $jobOfferRepository->findBy(['isActive' => true], orderBy: ["closingDate" => "DESC"]);
        return $this->render('home/jobs.html.twig', [
            'allJobs' => $allJobs,
        ]);
    }

    #[Route('/jobs/show/{id}', name: 'app_jobs_show', methods: ['GET'])]
    public function jobsShow(JobOffer $jobOffer, JobOfferRepository $jobOfferRepository): Response
    {
        $allJobs = $jobOfferRepository->findBy(['isActive' => true], orderBy: ["createdAt" => "DESC"]);
        
        $key = null;
        foreach ($allJobs as $needle => $job) {
            if($job->getId() === $jobOffer->getId()) $key = $needle;
        }

        if($key !== null){
            $prevJob = array_key_exists($key -1, $allJobs) ? $allJobs[$key -1] : $allJobs[array_key_last($allJobs)];
            $nextJob = array_key_exists($key +1, $allJobs) ? $allJobs[$key +1] : $allJobs[array_key_first($allJobs)];
        } else {
            $prevJob = $jobOffer;
            $nextJob = $jobOffer;
        }

        return $this->render('home/jobs_show.html.twig', [
            'jobOffer' => $jobOffer,
            'prevJob' => $prevJob,
            'nextJob' => $nextJob,
        ]);
    }

    #[Route('/profile', name: 'app_profile')]
    public function profile(): Response
    {
        return $this->render('home/profile.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
