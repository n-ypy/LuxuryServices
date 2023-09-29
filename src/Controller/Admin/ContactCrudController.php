<?php

namespace App\Controller\Admin;

use App\Entity\Contact;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ContactCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Contact::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setSearchFields(['status.statusValue'])
            ->setTimezone('Europe/Paris')
            ->setEntityLabelInSingular('Message')
            ->setEntityLabelInPlural('Messages');
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
            ->disable(Action::DELETE);
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('status');
    }

    public function createEntity(string $entityFqcn)
    {
        return (new $entityFqcn())->setCreatedAt();
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideWhenCreating()->hideWhenUpdating(),
            TextField::new('firstName')->hideWhenUpdating(),
            TextField::new('lastName')->hideWhenUpdating(),
            EmailField::new('email')->hideWhenUpdating(),
            TelephoneField::new('phoneNumber')->hideWhenUpdating(),
            TextareaField::new('content', 'Message')->hideWhenUpdating(),
            AssociationField::new('status'),
            DateTimeField::new('createdAt', 'Sent')->hideWhenCreating()->hideWhenUpdating(),
        ];
    }
}
