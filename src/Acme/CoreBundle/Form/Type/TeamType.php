<?php

namespace Acme\CoreBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints AS Assert;

/**
 * Class TeamType
 *
 * @package Acme\CoreBundle\Form\Type
 */
class TeamType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', Type\TextType::class, [
                'required'    => true,
                'constraints' => [
                    new Assert\Length([
                        'max' => 255
                    ])
                ]
            ])
            ->add('mascot', Type\TextType::class, [
                'required'    => true,
                'constraints' => [
                    new Assert\Length([
                        'max' => 255
                    ])
                ]
            ]);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'Acme\CoreBundle\Entity\Team',
        ]);
    }
}