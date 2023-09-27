<?php

namespace App\Form;

use App\Entity\Candidate;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CandidateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstName')
            ->add('lastName')
            ->add('adress')
            ->add('country')
            ->add('nationality')
            ->add('isPassportValid')
            ->add('currentLocation')
            ->add('dateOfBirth')
            ->add('placeOfBirth')
            ->add('isAvailable')
            ->add('shortDescription')
            ->add('createdAt')
            ->add('user')
            ->add('gender')
            ->add('passportFile')
            ->add('curriculumVitae')
            ->add('profilePicture')
            ->add('jobCategory')
            ->add('experience')
            ->add('notes')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Candidate::class,
        ]);
    }
}
