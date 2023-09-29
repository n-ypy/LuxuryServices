<?php

namespace App\Controller\Admin;

use App\Controller\Admin\AdminNotes\AdminNotesCrudController;
use App\Entity\Customer;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CustomerCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Customer::class;
    }

    public function createEntity(string $entityFqcn)
    {
        return (new $entityFqcn())
        ->setCreatedAt()
        ;
    }

    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        $entityInstance->setCreationDateOnNotes();
        $entityManager->persist($entityInstance);
        $entityManager->flush();
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideWhenCreating()->hideWhenUpdating(),
            TextField::new('companyName'),
            TextField::new('activityType'),
            TextField::new('contactName'),
            TextField::new('position'),
            TextField::new('contactPhoneNumber'),
            TextField::new('contactEmail'),
            AssociationField::new('notes')->renderAsEmbeddedForm(AdminNotesCrudController::class),
            CollectionField::new('jobOffers')->hideWhenCreating()->setDisabled(),
            DateTimeField::new('createdAt')->hideWhenCreating()->hideWhenUpdating(),
        ];
    }

}
