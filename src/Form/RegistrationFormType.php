<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
            ->add('username')

            ->add('type', ChoiceType::class, [
                'mapped' => false,
                'choices' => [
                    'Client' => 'customer',
                    'Entreprise' => 'company',
                ],
            ])
            ->add('plainPassword', PasswordType::class, [
                'mapped' => false,
            ]);
    }
}
