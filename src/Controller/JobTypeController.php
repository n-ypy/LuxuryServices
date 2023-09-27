<?php

namespace App\Controller;

use App\Entity\JobType;
use App\Form\JobTypeType;
use App\Repository\JobTypeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/job/type')]
class JobTypeController extends AbstractController
{
    #[Route('/', name: 'app_job_type_index', methods: ['GET'])]
    public function index(JobTypeRepository $jobTypeRepository): Response
    {
        return $this->render('job_type/index.html.twig', [
            'job_types' => $jobTypeRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_job_type_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $jobType = new JobType();
        $form = $this->createForm(JobTypeType::class, $jobType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($jobType);
            $entityManager->flush();

            return $this->redirectToRoute('app_job_type_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('job_type/new.html.twig', [
            'job_type' => $jobType,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_job_type_show', methods: ['GET'])]
    public function show(JobType $jobType): Response
    {
        return $this->render('job_type/show.html.twig', [
            'job_type' => $jobType,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_job_type_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, JobType $jobType, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(JobTypeType::class, $jobType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_job_type_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('job_type/edit.html.twig', [
            'job_type' => $jobType,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_job_type_delete', methods: ['POST'])]
    public function delete(Request $request, JobType $jobType, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$jobType->getId(), $request->request->get('_token'))) {
            $entityManager->remove($jobType);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_job_type_index', [], Response::HTTP_SEE_OTHER);
    }
}
