<?php

namespace App\Form;

use App\Entity\Genre;
use App\Entity\Movie;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;

class MovieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', null, [
                'label' => 'Titre',
                'empty_data' => '',
            ])
            // si on souhaite que Symfony devine lui-même le type de champ
            // en fonction du type Doctrine de la propriété $releaseDate de Movie
            ->add('release_date', null, [
                'label' => 'Date de sortie',
                'widget' => 'single_text',
            ])
            // ici on veut bien un textarea HTML
            ->add('summary', TextareaType::class, [
                'label' => 'Résumé',
                'help' => '400 caractères maximum.',
                // attribut HTML5
                'attr' => [
                    // hauteur
                    'class' => 'crud-textarea',
                ]
            ])
            ->add('synopsis', TextareaType::class, [
                'label' => 'Synopsis',
                // attribut HTML5
                'attr' => [
                    // hauteur
                    'class' => 'crud-textarea',
                ]
            ])
            ->add('poster', UrlType::class, [
                'label' => 'Affiche du film',
                'help' => 'URL de type https://',
                'default_protocol' => 'https',
            ])
            ->add('duration', NumberType::class, [
                'label' => 'Durée',
                'help' => 'En minutes.',
            ])
            // une petit ChoiceType en bouton radio ?
            ->add('type', ChoiceType::class, [
                'label' => 'Type de film',
                'choices'  => [
                    'Film' => 'Film',
                    'Série' => 'Série',
                ],
                // choix unique
                'multiple' => false,
                // plusieurs boutons
                'expanded' => true,
            ])
            // le rating sera calculé à partir des reviews du film, donc on masque ce champ
            // ->add('rating')

            // @link https://symfony.com/doc/current/reference/forms/types/entity.html
            ->add('genres', EntityType::class, [
                // depuis quelle entité va-t-on chercher les données
                'class' => Genre::class,
                // quelle propriété de Genre va servir de label au champ
                // permet d'éviter d'utiliser __toString()
                'choice_label' => 'name',
                // used to render a select box, check boxes or radios
                'multiple' => true,
                'expanded' => true,
                // BONUS : tri par name ASC
                // @link : https://symfony.com/doc/current/reference/forms/types/entity.html#using-a-custom-query-for-the-entities
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('g')
                        ->orderBy('g.name', 'ASC');
                },
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Movie::class,
            // pas de validation HTML5
            'attr' => [
                'novalidate' => 'novalidate',
            ]
        ]);
    }
}
