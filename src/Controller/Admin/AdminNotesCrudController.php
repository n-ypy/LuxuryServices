<?php

namespace App\Controller\Admin;

use App\Entity\AdminNotes;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;


class AdminNotesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return AdminNotes::class;
    }

    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        $entityInstance
        ->setCreatedAt();
        parent::persistEntity($entityManager, $entityInstance);
    }

    public function updateEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        $entityInstance->setUpdatedAt(new DateTimeImmutable());
        parent::updateEntity($entityManager, $entityInstance);
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setTimezone('Europe/Paris')
            ->setEntityLabelInSingular('Note')
            ->setEntityLabelInPlural('Notes')
            ->setDefaultSort(['id' => 'DESC']);
    }
    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextareaField::new('content', 'Note'),
            AssociationField::new('customer'),
            AssociationField::new('jobOffer'),
            AssociationField::new('candidate'),
            DateTimeField::new('updatedAt', 'Updated')->hideOnForm(),
            DateTimeField::new('createdAt', 'Created')->hideOnForm(),
        ];
    }

}
