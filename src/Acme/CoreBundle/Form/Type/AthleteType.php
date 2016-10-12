<?php

namespace Acme\CoreBundle\Form\Type;

use Acme\CoreBundle\Form\DataTransformer\IdToEntityTransformer;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints AS Assert;

/**
 * Class AthleteType
 *
 * @package Acme\CoreBundle\Form\Type
 */
class AthleteType extends AbstractType
{
    /**
     * @var EntityManager
     */
    protected $em;

    /**
     * AthleteType constructor.
     *
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('team', Type\HiddenType::class, [
                'required' => true
            ])
            ->add('first_name', Type\TextType::class, [
                'constraints' => [
                    new Assert\Length([
                        'max' => 255
                    ])
                ]
            ])
            ->add('last_name', Type\TextType::class, [
                'constraints' => [
                    new Assert\Length([
                        'max' => 255
                    ])
                ]
            ])
            ->add('position', Type\TextType::class, [
                'constraints' => [
                    new Assert\Length([
                        'max' => 255
                    ])
                ]
            ]);

        // Transform Asset
        $builder->get('team')->addViewTransformer(
            new IdToEntityTransformer($this->em, 'Acme\CoreBundle\Entity\Team')
        );
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'Acme\CoreBundle\Entity\Athlete',
        ]);
    }
}