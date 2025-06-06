<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Votre email'
                ],
                'label' => 'Email'
            ])
            ->add('contactEmail', EmailType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Email pour recevoir les messages de contact'
                ],
                'label' => 'Email de contact pour votre site',
                'required' => false,
                'help' => 'Cet email sera utilisé pour recevoir les messages de contact sur votre site généré'
            ])
            ->add('preferredStyle', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Ex: Minimaliste, Moderne, SaaS, Glassmorphism, etc.'
                ],
                'label' => 'Style préféré pour votre site',
                'required' => false
            ])
            ->add('businessType', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Ex: Restaurant, E-commerce, Blog, Portfolio...'
                ],
                'label' => 'Type d\'activité',
                'required' => false
            ])
            ->add('colorScheme', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Ex: Bleu et blanc, Tons chauds, Monochrome...'
                ],
                'label' => 'Palette de couleurs souhaitée',
                'required' => false
            ])
            ->add('additionalPreferences', TextareaType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Décrivez vos préférences supplémentaires pour la génération de votre site',
                    'rows' => 4
                ],
                'label' => 'Préférences supplémentaires',
                'required' => false
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'Vous devez accepter nos conditions.',
                    ]),
                ],
                'label' => 'J\'accepte les conditions d\'utilisation'
            ])
            ->add('plainPassword', PasswordType::class, [
                'mapped' => false,
                'attr' => [
                    'autocomplete' => 'new-password',
                    'class' => 'form-control',
                    'placeholder' => 'Votre mot de passe'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez entrer un mot de passe',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Votre mot de passe doit faire au moins {{ limit }} caractères',
                        'max' => 4096,
                    ]),
                ],
                'label' => 'Mot de passe'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}