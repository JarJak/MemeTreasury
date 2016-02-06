<?php

namespace Meme\MemeBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class MemeType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('image', VichImageType::class, [
                //'multiple' => true,
                'required' => false,
                'label' => 'Plik',
            ])
            ->add('tags', EntityType::class, [
                'class' => 'Meme\MemeBundle\Entity\Tag',
                'multiple' => true,
                'required' => false,
                'label' => 'Tagi',
            ])
            ->add('title', TextType::class, [
                'required' => false,
                'label' => 'Nazwa',
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Dodaj',
            ]);
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Meme\MemeBundle\Entity\Meme'
        ));
    }
}
