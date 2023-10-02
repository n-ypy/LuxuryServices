<?php

namespace App\Controller\Admin;

use App\Entity\GenderList;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class GenderListCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return GenderList::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setTimezone('Europe/Paris')
            ->setEntityLabelInSingular('Gender')
            ->setEntityLabelInPlural('Genders')
            ->setDefaultSort(['id' => 'DESC']);
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('genderValue', 'Gender'),
        ];
    }
}
