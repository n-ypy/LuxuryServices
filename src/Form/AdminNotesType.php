<?php

namespace App\Form;

use App\Entity\AdminNotes;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdminNotesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('content')
            ->add('updatedAt')
            ->add('createdAt')
            ->add('customer')
            ->add('jobOffer')
            ->add('candidate')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => AdminNotes::class,
        ]);
    }
}
