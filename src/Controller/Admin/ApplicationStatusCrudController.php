<?php

namespace App\Controller\Admin;

use App\Entity\ApplicationStatus;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ApplicationStatusCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ApplicationStatus::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
