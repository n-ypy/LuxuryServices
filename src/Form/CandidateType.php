<?php

namespace App\Form;

use App\Entity\Candidate;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CandidateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstName')
            ->add('lastName')
            ->add('adress', TextType::class, [
                "label" => false,
                "required" => false,
            ])
            ->add('country', CountryType::class, [
                'alpha3' => true,
                'placeholder' => '',
                "required" => false
            ])
            ->add('nationality')
            ->add('currentLocation', TextType::class, [
                "label" => false,
                "required" => false,
            ])
            ->add('dateOfBirth', DateType::class, [
                'html5' => true,  
                'widget' => 'single_text',
                "required" => false,
                ])
            ->add('placeOfBirth', TextType::class, [
                "label" => false,
                "required" => false,
            ])
            ->add('shortDescription', TextareaType::class, [
                "label" => false,
                "required" => false,
            ])
            ->add('gender')
            ->add('passportFile', MediaType::class)
            ->add('curriculumVitae', MediaType::class)
            ->add('profilePicture', MediaType::class)
            ->add('jobCategory')
            ->add('experience')
            ->add('isAvailable')
            ->add('isPassportValid')
            ->add('user' , ChangePasswordOnProfileFormType::class )
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Candidate::class,
        ]);
    }
}
