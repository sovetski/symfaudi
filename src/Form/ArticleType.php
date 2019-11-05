<?php

namespace App\Form;

use App\Entity\Article;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', null, [
                'label' => 'Titre',
                'required' => true
            ])
            ->add('content',null, [
                'label' => 'Contenu',
                'required' => true
            ])
            ->add('imageUrl',null, [
                'label' => 'URL de l\'image',
                'required' => true
            ]);

        if ($options['full']) {
            $builder
                ->add('publishedAt', DateType::class, [
                    'widget' => 'single_text',
                    'label' => 'Date de publication',
                    'required' => false
                ]);
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
            'full' => true
        ]);
    }
}
