<?php

namespace App\Controller\Admin\AdminNotes;

use App\Entity\AdminNotes;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;

class AdminNotesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return AdminNotes::class;
    }

    public function createEntity(string $entityFqcn)
    {
        dd('createEntity');
        return new $entityFqcn();
    }

    public function updateEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        dd('updateEntity');

        $entityManager->persist($entityInstance);
        $entityManager->flush();
    }

    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        dd('persistEntity');

        $entityManager->persist($entityInstance);
        $entityManager->flush();
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideWhenCreating()->hideWhenUpdating(),
            TextareaField::new('content', 'Notes')->setRequired(false)->setEmptyData(''),
        ];
    }

}
