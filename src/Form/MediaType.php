<?php

namespace App\Form;

use App\Entity\Media;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class MediaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('url', FileType::class, [
                "label" => false,
                "required" => false,
                "empty_data" => '',
                'mapped' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '5120k',
                        'mimeTypes' => [
                            'application/pdf',
                            'application/x-pdf',
                            'image/*'
                        ],
                        'mimeTypesMessage' => 'The format is not valid',
                    ])
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Media::class,
        ]);
    }
}
