<?php

namespace Acme\CoreBundle\Form\DataTransformer;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class IdToEntityTransformer implements DataTransformerInterface
{
    /**
     * @var EntityManager
     */
    private $em;

    /**
     * @var string
     */
    private $entityName;

    /**
     * @param EntityManager $em
     * @param string $entityName
     */
    public function __construct(EntityManager $em, $entityName)
    {
        $this->em         = $em;
        $this->entityName = $entityName;
    }

    /**
     * Extract id from object
     *
     * @param object|null $object
     *
     * @return string
     */
    public function transform($object)
    {
        if (null === $object) {
            return '';
        }

        return $object->getId();
    }

    /**
     * @param int $id
     *
     * @throws TransformationFailedException if object is not found.
     * @return object|null
     */
    public function reverseTransform($id)
    {
        $object = null;

        if ($id != null) {
            $object = $this->em
                ->getRepository($this->entityName)
                ->find($id);

            if (null === $object) {
                throw new TransformationFailedException(sprintf(
                    'Entity with id "%s" does not exist!', $id
                ));
            }
        }

        return $object;
    }
}