<?php

namespace App\Form;

use App\Entity\Author;
use App\Entity\Category;
use App\Entity\News;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NewsFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title',TextType::class)
            ->add('content',TextType::class)
            ->add('image_url',TextType::class)
            ->add('publication_date',TextType::class)
            ->add('author',EntityType::class,array(
                'label' =>'author',
                'class' => Author::class
            ))
            ->add('category',EntityType::class,array(
                'label' =>'Category',
                'class'=>Category::class,
                'multiple'=>true
            ))
            ->add('submit',  SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => News::class,
        ]);
    }
}
