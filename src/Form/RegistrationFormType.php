<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', TextType::class,[
                'label' => 'Prénom*',
                'attr' => [
                    'placeholder' => 'Entrer votre prénom',
                ],
            ])
            ->add('lastname', TextType::class,[
                'label' => 'Nom*',
                'attr' => [
                    'placeholder' => 'Entrer votre nom',
                ],
            ])
            ->add('email', EmailType::class,[
                'label' => 'E-mail*',
                'attr' => [
                    'placeholder' => 'Entrer votre adresse email',
                ],
            ])
            // ->add('plainPassword', PasswordType::class, [
            //     // instead of being set onto the object directly,
            //     // this is read and encoded in the controller
            //     'mapped' => false,
            //     'attr' => ['autocomplete' => 'new-password'],
            //     'constraints' => [
            //         new NotBlank([
            //             'message' => 'Please enter a password',
            //         ]),
            //         new Length([
            //             'min' => 6,
            //             'minMessage' => 'Your password should be at least {{ limit }} characters',
            //             // max length allowed by Symfony for security reasons
            //             'max' => 4096,
            //         ]),
            //     ],
            // ])

            ->add('plainPassword', RepeatedType::class, [
                'mapped' => false,
                'attr' => [
                    'autocomplete' => 'new-password',
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
                'type' => PasswordType::class,
                'invalid_message' => 'The password fields must match.',
                'options' => ['attr' => ['class' => 'password-field']],
                'required' => true,
                'first_options'  => ['label' => 'Mot de passe*', 'attr' => ['placeholder' => 'Entrer votre mot de passe']],
                'second_options' => ['label' => 'Confirmer le mot de passe*', 'attr' => ['placeholder' => 'Entrer votre mot de passe']],
            ])




            ->add('phoneNumber', TextType::class,[
                'required' => false,
                'label' => 'Numéro de téléphone',
                'attr' => [
                    'placeholder' => 'Entrer votre numéro de téléphone',
                ],
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'label' => "J'accepte que Charles Allard utilise mes informations personnelles",
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'Vous devez accepter les conditions général',
                    ]),
                ],
                // 'attr' => [
                //     'class' => 'agree-term',
                // ],
            ]);
        // ->add('save', SubmitType::class, [
        //     'label' => "S'inscrire"
        // ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
