<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Repository\ContactStatusRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
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
    public function jobs(): Response
    {
        return $this->render('home/jobs.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/jobs/show', name: 'app_jobs_show')]
    public function jobsShow(): Response
    {
        return $this->render('home/jobs_show.html.twig', [
            'controller_name' => 'HomeController',
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
