<?php

namespace App\Controller\Admin;

use App\Controller\Admin\AdminNotes\AdminNotesCrudController;
use App\Entity\Candidate;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CountryField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CandidateCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Candidate::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
            ->disable(Action::DELETE);
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setTimezone('Europe/Paris')
            ->setEntityLabelInSingular('Candidate')
            ->setEntityLabelInPlural('Candidates')
            ->setDefaultSort(['createdAt' => 'DESC']);
    }

    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        if($entityInstance->getNotes() !== null)
        {
            if($entityInstance->getNotes()->getContent() === "")
            {
               $entityInstance->setNotes(null);
            }
        }
        $entityInstance
        ->setCreatedAt()
        ->setCreationDateOnNotesAndMedia();
        parent::persistEntity($entityManager, $entityInstance);
    }

    public function updateEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {

        if ($entityInstance->getNotes() !== null) {
            if ($entityInstance->getNotes()->getContent() === "") {
                if ($entityInstance->getNotes()->getId() !== null) {
                    $notes = $entityInstance->getNotes();
                    $deleteNotes = true;
                }
                $entityInstance->setNotes(null);
            }
        }

        $entityInstance->setCreationDateOnNotesAndMedia();

        parent::updateEntity($entityManager, $entityInstance);

        if (isset($deleteNotes)) {
            $this->deleteEntity($entityManager, $notes);
        }
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('firstName'),
            TextField::new('lastName'),
            AssociationField::new('gender')->hideOnIndex(),
            AssociationField::new('user', 'Email')->hideWhenUpdating(),
            TextareaField::new('adress')->hideOnIndex(),
            CountryField::new('country'),
            TextField::new('nationality')->hideOnIndex(),
            BooleanField::new('isPassportValid', 'Passport Validity'),
            AssociationField::new('passportFile', 'Passport')->setCrudController(MediaCrudController::class)->renderAsEmbeddedForm()->hideOnIndex(),
            AssociationField::new('curriculumVitae')->setCrudController(MediaCrudController::class)->renderAsEmbeddedForm()->hideOnIndex(),
            AssociationField::new('profilePicture')->setCrudController(MediaCrudController::class)->renderAsEmbeddedForm(),
            TextareaField::new('currentLocation')->hideOnIndex(),
            DateField::new('dateOfBirth'),
            TextareaField::new('placeOfBirth')->hideOnIndex(),
            BooleanField::new('isAvailable', 'Availability'),
            AssociationField::new('jobCategory'),
            AssociationField::new('experience')->hideOnIndex(),
            TextareaField::new('shortDescription', 'Description')->hideOnIndex(),
            CollectionField::new('applications')->hideOnForm()->hideOnIndex(),
            AssociationField::new('notes')->renderAsEmbeddedForm(AdminNotesCrudController::class)->setRequired(false),
            DateTimeField::new('createdAt')->hideOnForm(),
        ];
    }

}
