<?php

namespace App\Controller\Admin;

use App\Controller\Admin\AdminNotes\AdminNotesCrudController;
use App\Entity\AdminNotes;
use App\Entity\JobOffer;
use App\Repository\AdminNotesRepository;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class JobOfferCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return JobOffer::class;
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

        $entityInstance
            ->setUpdatedAt(new DateTimeImmutable())
            ->setCreationDateOnNotes();

        parent::updateEntity($entityManager, $entityInstance);

        if (isset($deleteNotes)) {
            $this->deleteEntity($entityManager, $notes);
        }
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setTimezone('Europe/Paris')
            ->setEntityLabelInSingular('Job offer')
            ->setEntityLabelInPlural('Job offers')
            ->setDefaultSort(['createdAt' => 'DESC']);
    }

    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        if ($entityInstance->getNotes() !== null) {
            if ($entityInstance->getNotes()->getContent() === "") {
                $entityInstance->setNotes(null);
            }
        }

        $entityInstance
            ->setCreatedAt()
            ->setReference()
            ->setCreationDateOnNotes();
        parent::persistEntity($entityManager, $entityInstance);
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL);
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('customer');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('reference')->hideOnForm(),
            AssociationField::new('customer'),
            BooleanField::new('isActive', 'Active'),
            TextField::new('jobTitle'),
            TextField::new('position'),
            TextEditorField::new('description')->setTrixEditorConfig([
                'blockAttributes' => [
                    'default' => ['tagName' => 'p'],
                    'heading1' => ['tagName' => 'h4'],
                ]]),
            AssociationField::new('jobCategory'),
            AssociationField::new('jobType'),
            TextField::new('location'),
            IntegerField::new('salary'),
            DateField::new('closingDate'),
            CollectionField::new('applications')->hideOnForm(),
            AssociationField::new('notes')->renderAsEmbeddedForm(AdminNotesCrudController::class)->setRequired(false),
            DateTimeField::new('updatedAt', 'Updated')->hideOnForm(),
            DateTimeField::new('createdAt', 'Created')->hideOnForm(),
        ];
    }
}
