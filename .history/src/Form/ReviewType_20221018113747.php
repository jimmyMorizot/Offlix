<?php

namespace App\Form;

use App\Entity\Review;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ReviewType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username', TextType::class, [
                'label' => 'Pseudo',
            ])
            ->add('email', EmailType::class, [
                'label' => 'E-mail',
            ])
            ->add('content', TextareaType::class, [
                'label' => 'Avis',
            ])
            // /!\ Important pour comprendre les types ChoiceType
            // @link https://symfony.com/doc/current/reference/forms/types/choice.html#select-tag-checkboxes-or-radio-buttons
            ->add('rating', ChoiceType::class, [
                // On masque le label et on affiche un placeholder
                'label' => false,
                // Choix vide par défaut
                'placeholder' => 'Vous avez trouvé ce film...',
                'choices' => [
                    'Excellent' => 5,
                    'Très bon' => 4,
                    'Bon' => 3,
                    'Peut mieux faire' => 2,
                    'A éviter' => 1,
                ],
                // Pas de choix multiple
                'multiple' => false,
                // Un seul widget HTML
                'expanded' => false,
            ])
            ->add('reactions', ChoiceType::class, [
                'label' => 'Ce film vous a fait',
                'choices' => [
                    'Rire' => 'smile',
                    'Pleurer' => 'cry',
                    'Penser' => 'think',
                    'Dormir' => 'sleep',
                    'Rêver' => 'dream'
                ],
                // Choix multiple
                'multiple' => true,
                // Un widget HTML par choix
                'expanded' => true,
            ])
            ->add('watchedAt', DateType::class, [
                'label' => 'Vous avez vu ce film le',
                'input'=>'datetime_immutable',
                'format' => 'ddMMyyyy',
            ])
            // Pas besoin de movie puisqu'on est sur la page
            // et on ne veut surout pas que l'utilisateur modifie cette propriété
            // ->add('movie')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        // On configure les options du form ici
        $resolver->setDefaults([
            'data_class' => Review::class,
            // HTML5 validation
            'attr' => [
                'novalidate' => 'novalidate',
            ]
        ]);
    }
}
