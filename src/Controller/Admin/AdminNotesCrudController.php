<?php

namespace App\Controller\Admin;

use App\Entity\AdminNotes;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class AdminNotesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return AdminNotes::class;
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
