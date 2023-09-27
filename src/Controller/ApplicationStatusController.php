<?php

namespace App\Controller;

use App\Entity\ApplicationStatus;
use App\Form\ApplicationStatusType;
use App\Repository\ApplicationStatusRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/application/status')]
class ApplicationStatusController extends AbstractController
{
    #[Route('/', name: 'app_application_status_index', methods: ['GET'])]
    public function index(ApplicationStatusRepository $applicationStatusRepository): Response
    {
        return $this->render('application_status/index.html.twig', [
            'application_statuses' => $applicationStatusRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_application_status_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $applicationStatus = new ApplicationStatus();
        $form = $this->createForm(ApplicationStatusType::class, $applicationStatus);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($applicationStatus);
            $entityManager->flush();

            return $this->redirectToRoute('app_application_status_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('application_status/new.html.twig', [
            'application_status' => $applicationStatus,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_application_status_show', methods: ['GET'])]
    public function show(ApplicationStatus $applicationStatus): Response
    {
        return $this->render('application_status/show.html.twig', [
            'application_status' => $applicationStatus,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_application_status_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ApplicationStatus $applicationStatus, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ApplicationStatusType::class, $applicationStatus);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_application_status_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('application_status/edit.html.twig', [
            'application_status' => $applicationStatus,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_application_status_delete', methods: ['POST'])]
    public function delete(Request $request, ApplicationStatus $applicationStatus, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$applicationStatus->getId(), $request->request->get('_token'))) {
            $entityManager->remove($applicationStatus);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_application_status_index', [], Response::HTTP_SEE_OTHER);
    }
}
