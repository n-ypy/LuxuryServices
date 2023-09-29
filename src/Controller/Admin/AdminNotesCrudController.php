<?php

namespace App\Controller\Admin;

use App\Entity\AdminNotes;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class AdminNotesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return AdminNotes::class;
    }

    public function createEntity(string $entityFqcn)
    {
        return (new $entityFqcn())->setCreatedAt();
    }

    public function updateEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        $entityInstance->setUpdatedAt(new DateTimeImmutable());
        $entityManager->persist($entityInstance);
        $entityManager->flush();
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideWhenCreating()->hideWhenUpdating(),
            TextareaField::new('content'),
            DateTimeField::new('updatedAt')->hideWhenCreating()->hideWhenUpdating(),
            DateTimeField::new('createdAt')->hideWhenCreating()->hideWhenUpdating(),
            AssociationField::new('customer'),
        ];
    }

}
