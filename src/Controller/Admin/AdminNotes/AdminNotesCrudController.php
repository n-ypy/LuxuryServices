<?php

namespace App\Controller\Admin\AdminNotes;

use App\Entity\AdminNotes;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;

class AdminNotesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return AdminNotes::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideWhenCreating()->hideWhenUpdating(),
            TextareaField::new('content', 'Notes')->setRequired(false)->setEmptyData(''),
        ];
    }

}
