<?php

namespace App\Controller\Admin;

use App\Entity\Media;
use Closure;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Form\Type\FileUploadType;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class MediaCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Media::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setTimezone('Europe/Paris')
            ->setEntityLabelInSingular('Media')
            ->setEntityLabelInPlural('Medias')
            ->setDefaultSort(['id' => 'DESC']);
    }

    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        $entityInstance->setCreatedAt();
        parent::persistEntity($entityManager, $entityInstance);
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL);
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            ImageField::new('url')
                ->setBasePath('assets/uploads/')
                ->setUploadDir('public/assets/uploads/')
                ->setSortable(false),
            // TextField::new('url')
            //     ->setFormType(FileUploadType::class)
            //     ->setFormTypeOptions(['upload_dir' => 'public/assets/uploads', 'allow_delete' => true, 'upload_filename' => "[name].[extension]"])
            //     ->setSortable(false),
            AssociationField::new('candidatePassportFile')->hideOnForm(),
            AssociationField::new('candidateCurriculumVitae')->hideOnForm(),
            AssociationField::new('candidateProfilePicture')->hideOnForm(),
            DateTimeField::new('createdAt')->hideOnForm()
        ];
    }
}
