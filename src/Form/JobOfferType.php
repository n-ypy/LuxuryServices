<?php

namespace App\Form;

use App\Entity\JobOffer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class JobOfferType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('reference')
            ->add('isActive')
            ->add('jobTitle')
            ->add('location')
            ->add('closingDate')
            ->add('salary')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('customer')
            ->add('notes')
            ->add('jobType')
            ->add('jobCategory')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => JobOffer::class,
        ]);
    }
}
