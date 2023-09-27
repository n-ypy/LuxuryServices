<?php

namespace App\Controller;

use App\Entity\GenderList;
use App\Form\GenderListType;
use App\Repository\GenderListRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/gender/list')]
class GenderListController extends AbstractController
{
    #[Route('/', name: 'app_gender_list_index', methods: ['GET'])]
    public function index(GenderListRepository $genderListRepository): Response
    {
        return $this->render('gender_list/index.html.twig', [
            'gender_lists' => $genderListRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_gender_list_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $genderList = new GenderList();
        $form = $this->createForm(GenderListType::class, $genderList);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($genderList);
            $entityManager->flush();

            return $this->redirectToRoute('app_gender_list_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('gender_list/new.html.twig', [
            'gender_list' => $genderList,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_gender_list_show', methods: ['GET'])]
    public function show(GenderList $genderList): Response
    {
        return $this->render('gender_list/show.html.twig', [
            'gender_list' => $genderList,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_gender_list_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, GenderList $genderList, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(GenderListType::class, $genderList);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_gender_list_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('gender_list/edit.html.twig', [
            'gender_list' => $genderList,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_gender_list_delete', methods: ['POST'])]
    public function delete(Request $request, GenderList $genderList, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$genderList->getId(), $request->request->get('_token'))) {
            $entityManager->remove($genderList);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_gender_list_index', [], Response::HTTP_SEE_OTHER);
    }
}
