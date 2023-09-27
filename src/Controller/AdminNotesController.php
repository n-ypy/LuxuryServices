<?php

namespace App\Controller;

use App\Entity\AdminNotes;
use App\Form\AdminNotesType;
use App\Repository\AdminNotesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/notes')]
class AdminNotesController extends AbstractController
{
    #[Route('/', name: 'app_admin_notes_index', methods: ['GET'])]
    public function index(AdminNotesRepository $adminNotesRepository): Response
    {
        return $this->render('admin_notes/index.html.twig', [
            'admin_notes' => $adminNotesRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_notes_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $adminNote = new AdminNotes();
        $form = $this->createForm(AdminNotesType::class, $adminNote);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($adminNote);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_notes_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin_notes/new.html.twig', [
            'admin_note' => $adminNote,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_notes_show', methods: ['GET'])]
    public function show(AdminNotes $adminNote): Response
    {
        return $this->render('admin_notes/show.html.twig', [
            'admin_note' => $adminNote,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_notes_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, AdminNotes $adminNote, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AdminNotesType::class, $adminNote);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_notes_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin_notes/edit.html.twig', [
            'admin_note' => $adminNote,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_notes_delete', methods: ['POST'])]
    public function delete(Request $request, AdminNotes $adminNote, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$adminNote->getId(), $request->request->get('_token'))) {
            $entityManager->remove($adminNote);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_admin_notes_index', [], Response::HTTP_SEE_OTHER);
    }
}
