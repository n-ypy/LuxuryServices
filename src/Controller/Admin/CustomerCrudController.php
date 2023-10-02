<?php

namespace App\Controller\Admin;

use App\Controller\Admin\AdminNotes\AdminNotesCrudController;
use App\Entity\Customer;
use App\Repository\AdminNotesRepository;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CustomerCrudController extends AbstractCrudController
{

    public static function getEntityFqcn(): string
    {
        return Customer::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setTimezone('Europe/Paris')
            ->setEntityLabelInSingular('Customer')
            ->setEntityLabelInPlural('Customers')
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
        ->setCreationDateOnNotes()
        ;
        parent::persistEntity($entityManager, $entityInstance);
    }

    public function updateEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        if($entityInstance->getNotes() !== null)
        {
            if($entityInstance->getNotes()->getContent() === "")
            {
                if($entityInstance->getNotes()->getId() !== null)
                {
                    $this->deleteEntity($entityManager, $entityInstance->getNotes());
                }
               $entityInstance->setNotes(null);
            }
        }

        $entityInstance
        ->setCreationDateOnNotes();
        parent::updateEntity($entityManager, $entityInstance);
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('companyName'),
            TextField::new('activityType'),
            TextField::new('contactName'),
            TextField::new('position'),
            TelephoneField::new('contactPhoneNumber', 'Phone'),
            EmailField::new('contactEmail', 'Email'),
            AssociationField::new('notes')->renderAsEmbeddedForm(AdminNotesCrudController::class)->setRequired(false),
            CollectionField::new('jobOffers')->hideWhenCreating()->setDisabled(),
            DateTimeField::new('createdAt', 'Added')->hideOnForm(),
        ];
    }

}
