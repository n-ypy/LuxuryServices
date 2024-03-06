<?php

namespace App\Controller;

use App\Entity\Application;
use App\Entity\Contact;
use App\Entity\JobOffer;
use App\Form\ApplicationType;
use App\Form\CandidateType;
use App\Form\ContactType;
use App\Form\DeleteAccountType;
use App\Repository\ApplicationStatusRepository;
use App\Repository\ContactStatusRepository;
use App\Repository\JobOfferRepository;
use App\Service\FileUploader;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\InputBag;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(JobOfferRepository $jobOfferRepository, Request $request, EntityManagerInterface $entityManager, ApplicationStatusRepository $applicationStatusRepository,  Security $security): Response
    {
        $application = new Application();
        $allJobs = $jobOfferRepository->findBy(['isActive' => true], limit: 10, orderBy: ["createdAt" => "DESC"]);

        if ($allJobs !== null || $allJobs = []) {
            $forms = [];
            $formsViews = [];
            foreach ($allJobs as $job) {
                $forms[$job->getId()] = $this->createForm(ApplicationType::class, $application);
                $forms[$job->getId()]->handleRequest($request);

                if ($forms[$job->getId()]->isSubmitted() && $forms[$job->getId()]->isValid()) {
                    $application->setCreatedAt(new DateTimeImmutable());
                    $status = $applicationStatusRepository->findOneBy(['statusValue' => "Pending"]);
                    $application->setCandidate($security->getUser()->getCandidate());
                    $application->setStatus($status);

                    $entityManager->persist($application);
                    $entityManager->flush();
                }
                $formsViews[$job->getId()] = $forms[$job->getId()]->createView();
            }
        }

        $profileComplete = null;
        if ($security->getUser() !== null) {
            $profileComplete = $security->getUser()
                ->getCandidate()
                ->isProfileComplete();
        }

        return $this->render('home/index.html.twig', [
            'allJobs' => $allJobs,
            'forms' => $formsViews,
            'profileComplete' => $profileComplete,
            'home' => true
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
            'contact' => true
        ]);
    }




    #[Route('/company', name: 'app_company')]
    public function company(): Response
    {
        return $this->render('home/company.html.twig', [
            'about_us' => true
        ]);
    }




    #[Route('/jobs', name: 'app_jobs')]
    public function jobs(JobOfferRepository $jobOfferRepository, Request $request, EntityManagerInterface $entityManager, ApplicationStatusRepository $applicationStatusRepository,  Security $security): Response
    {
        $application = new Application();
        $allJobs = $jobOfferRepository->findBy(['isActive' => true], orderBy: ["createdAt" => "DESC"]);

        if ($allJobs !== null || $allJobs = []) {
            $forms = [];
            $formsViews = [];
            foreach ($allJobs as $job) {
                $forms[$job->getId()] = $this->createForm(ApplicationType::class, $application);
                $forms[$job->getId()]->handleRequest($request);

                if ($forms[$job->getId()]->isSubmitted() && $forms[$job->getId()]->isValid()) {
                    $application->setCreatedAt(new DateTimeImmutable());
                    $status = $applicationStatusRepository->findOneBy(['statusValue' => "Pending"]);
                    $application->setCandidate($security->getUser()->getCandidate());
                    $application->setStatus($status);

                    $entityManager->persist($application);
                    $entityManager->flush();
                }
                $formsViews[$job->getId()] = $forms[$job->getId()]->createView();
            }
        }

        $profileComplete = null;
        if ($security->getUser() !== null) {
            $profileComplete = $security->getUser()
                ->getCandidate()
                ->isProfileComplete();
        }

        return $this->render('home/jobs.html.twig', [
            'allJobs' => $allJobs,
            'forms' => $formsViews,
            'profileComplete' => $profileComplete,
            'job_offers' => true
        ]);
    }




    #[Route('/jobs/show/{id}', name: 'app_jobs_show', methods: ['GET', 'POST'])]
    public function jobsShow(JobOffer $jobOffer, JobOfferRepository $jobOfferRepository, Request $request, EntityManagerInterface $entityManager, ApplicationStatusRepository $applicationStatusRepository,  Security $security): Response
    {
        $allJobs = $jobOfferRepository->findBy(['isActive' => true], orderBy: ["createdAt" => "DESC"]);

        $key = null;
        foreach ($allJobs as $needle => $job) {
            if ($job->getId() === $jobOffer->getId()) $key = $needle;
        }

        if ($key !== null) {
            $prevJob = array_key_exists($key - 1, $allJobs) ? $allJobs[$key - 1] : $allJobs[array_key_last($allJobs)];
            $nextJob = array_key_exists($key + 1, $allJobs) ? $allJobs[$key + 1] : $allJobs[array_key_first($allJobs)];
        } else {
            $prevJob = $jobOffer;
            $nextJob = $jobOffer;
        }

        $application = new Application();
        $form = $this->createForm(ApplicationType::class, $application);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $application->setCreatedAt(new DateTimeImmutable());
            $status = $applicationStatusRepository->findOneBy(['statusValue' => "Pending"]);
            $application->setCandidate($security->getUser()->getCandidate());
            $application->setStatus($status);
            $entityManager->persist($application);
            $entityManager->flush();
        }

        $profileComplete = null;
        if ($security->getUser() !== null) {
            $profileComplete = $security->getUser()
                ->getCandidate()
                ->isProfileComplete();
        }

        return $this->render('home/jobs_show.html.twig', [
            'jobOffer' => $jobOffer,
            'prevJob' => $prevJob,
            'nextJob' => $nextJob,
            'form' => $form->createView(),
            'profileComplete' => $profileComplete
        ]);
    }




    #[Route('/profile', name: 'app_profile', methods: ['GET', 'POST'])]
    public function profile(FileUploader $fileUploader, Security $security, Request $request, EntityManagerInterface $entityManagerInterface, UserPasswordHasherInterface $userPasswordHasher): Response
    {
        $user = $security->getUser();
        $deleteAccountForm = $this->createForm(DeleteAccountType::class, $user);
        $deleteAccountForm->handleRequest($request);

        if ($deleteAccountForm->isSubmitted() && $deleteAccountForm->isValid()) {
            $entityManagerInterface->flush();
            $security->logout(false);
            return $this->redirectToRoute('app_home', [], Response::HTTP_SEE_OTHER);
        }

        $updatePwdErrMsg = null;
        $candidate = $security->getUser()->getCandidate();
        $form = $this->createForm(CandidateType::class, $candidate);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $passportFile = $form->get('passportFile')->get('url')->getData();
            $profilePicture = $form->get('profilePicture')->get('url')->getData();
            $curriculumVitae = $form->get('curriculumVitae')->get('url')->getData();
            
            if($passportFile){
                $fileName = $fileUploader->upload($passportFile, FileUploader::PASSPORT_DIR);
                $media = $candidate->getPassportFile();
                $media->setUrl($fileName);
                $candidate->setPassportFile($media);
            } elseif ($candidate->getPassportFile()->getUrl() === null) {
                $candidate->setPassportFile(null);
            } 
            

            if($profilePicture){
                $fileName = $fileUploader->upload($profilePicture, FileUploader::PROFILE_PICTURE_DIR);
                $media = $candidate->getProfilePicture();
                $media->setUrl($fileName);
                $candidate->setProfilePicture($media);
            } elseif ($candidate->getProfilePicture()->getUrl() === null) {
                $candidate->setProfilePicture(null);
            }


            if($curriculumVitae){
                $fileName = $fileUploader->upload($curriculumVitae, FileUploader::CV_DIR);
                $media = $candidate->getCurriculumVitae();
                $media->setUrl($fileName);
                $candidate->setCurriculumVitae($media);
            } elseif ($candidate->getCurriculumVitae()->getUrl() === null) {
                $candidate->setCurriculumVitae(null);
            }

            $userEmail = $form->get("user")->get("email")->getData();
            $userPasdsword = $form->get("user")->get("password")->getData();


            if(iterator_count($user->verifyEmailAndPasswordBeforeUpdate($userEmail, $user->getEmail(), $userPasdsword)) === 0 && $userEmail !== null && $userPasdsword !== null)
            {
                $encodedPassword = $userPasswordHasher->hashPassword(
                    $user,
                    $userPasdsword
                );
                $candidate->setUser($user->setPassword($encodedPassword));
            }

            $candidate->setCreationDateOnNotesAndMedia();
            $entityManagerInterface->persist($candidate);
            $entityManagerInterface->flush();
        }

        return $this->render('home/profile.html.twig', [
            'form' => $form->createView(),
            'deleteAccountForm' => $deleteAccountForm->createView(),
            'percentProfileComplete' => $candidate->returnsPercentProfileComplete(InputBag::class),
            'updatePwdErrMsg' =>  $updatePwdErrMsg,
            'profile' => true
        ]);
    }
}
