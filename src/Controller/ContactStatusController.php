<?php

namespace App\Controller;

use App\Entity\ContactStatus;
use App\Form\ContactStatusType;
use App\Repository\ContactStatusRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/contact/status')]
class ContactStatusController extends AbstractController
{
    #[Route('/', name: 'app_contact_status_index', methods: ['GET'])]
    public function index(ContactStatusRepository $contactStatusRepository): Response
    {
        return $this->render('contact_status/index.html.twig', [
            'contact_statuses' => $contactStatusRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_contact_status_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $contactStatus = new ContactStatus();
        $form = $this->createForm(ContactStatusType::class, $contactStatus);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($contactStatus);
            $entityManager->flush();

            return $this->redirectToRoute('app_contact_status_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('contact_status/new.html.twig', [
            'contact_status' => $contactStatus,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_contact_status_show', methods: ['GET'])]
    public function show(ContactStatus $contactStatus): Response
    {
        return $this->render('contact_status/show.html.twig', [
            'contact_status' => $contactStatus,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_contact_status_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ContactStatus $contactStatus, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ContactStatusType::class, $contactStatus);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_contact_status_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('contact_status/edit.html.twig', [
            'contact_status' => $contactStatus,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_contact_status_delete', methods: ['POST'])]
    public function delete(Request $request, ContactStatus $contactStatus, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$contactStatus->getId(), $request->request->get('_token'))) {
            $entityManager->remove($contactStatus);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_contact_status_index', [], Response::HTTP_SEE_OTHER);
    }
}
