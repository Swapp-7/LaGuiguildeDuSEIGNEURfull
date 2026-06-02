<?php

namespace App\Form;

use App\Entity\Character;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Range;

class ApiCharacterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // --- Identité ---
            ->add('name', TextType::class, [
                'label'       => 'Nom du personnage',
                'required'    => true,
                'attr'        => [
                    'placeholder' => 'Ex : Aragorn',
                    'maxlength'   => 20,
                    'class'       => 'form-control',
                ],
                'help'        => 'Nom unique, 20 caractères max.',
                'constraints' => [
                    new NotBlank(message: 'Le nom est obligatoire.'),
                    new Length(max: 20, maxMessage: '20 caractères maximum.'),
                ],
            ])
            ->add('surname', TextType::class, [
                'label'       => 'Surnom',
                'required'    => true,
                'attr'        => [
                    'placeholder' => 'Ex : Le Rôdeur',
                    'maxlength'   => 50,
                    'class'       => 'form-control',
                ],
                'help'        => 'Surnom ou titre du personnage.',
                'constraints' => [
                    new NotBlank(message: 'Le surnom est obligatoire.'),
                    new Length(max: 50, maxMessage: '50 caractères maximum.'),
                ],
            ])
            ->add('kind', ChoiceType::class, [
                'label'    => 'Genre',
                'required' => true,
                'choices'  => [
                    'Seigneur' => 'Seigneur',
                    'Dame'     => 'Dame',
                ],
                'attr'     => ['class' => 'form-select'],
                'help'     => 'Titre nobiliaire du personnage.',
            ])

            // --- Origine & Savoir ---
            ->add('caste', TextType::class, [
                'label'    => 'Caste',
                'required' => false,
                'attr'     => [
                    'placeholder' => 'Ex : Guerrier, Mage, Clerc…',
                    'maxlength'   => 20,
                    'class'       => 'form-control',
                ],
                'help'     => 'Appartenance sociale ou classe du personnage.',
            ])
            ->add('knowledge', TextType::class, [
                'label'    => 'Savoir',
                'required' => false,
                'attr'     => [
                    'placeholder' => 'Ex : Alchimie, Épée, Magie…',
                    'maxlength'   => 20,
                    'class'       => 'form-control',
                ],
                'help'     => 'Domaine de compétence principal.',
            ])

            // --- Statistiques ---
            ->add('intellingence', IntegerType::class, [
                'label'       => 'Intelligence',
                'required'    => false,
                'attr'        => [
                    'min'         => 1,
                    'max'         => 250,
                    'placeholder' => '1 – 250',
                    'class'       => 'form-control',
                ],
                'help'        => 'Capacité intellectuelle (1 = faible, 250 = génie).',
                'constraints' => [
                    new Range(min: 1, max: 250, notInRangeMessage: 'Valeur entre 1 et 250.'),
                ],
            ])
            ->add('strenght', IntegerType::class, [
                'label'       => 'Force',
                'required'    => false,
                'attr'        => [
                    'min'         => 1,
                    'max'         => 250,
                    'placeholder' => '1 – 250',
                    'class'       => 'form-control',
                ],
                'help'        => 'Puissance physique (1 = chétif, 250 = colossal).',
                'constraints' => [
                    new Range(min: 1, max: 250, notInRangeMessage: 'Valeur entre 1 et 250.'),
                ],
            ])

            // --- Apparence ---
            ->add('image', TextType::class, [
                'label'    => 'Image (URL)',
                'required' => false,
                'attr'     => [
                    'placeholder' => 'https://…/portrait.jpg',
                    'maxlength'   => 50,
                    'class'       => 'form-control',
                ],
                'help'     => 'URL du portrait du personnage.',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
           'data_class' => null, // C'est un array et non un Character
        ]);
    }
}
