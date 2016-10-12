<?php

namespace Acme\CoreBundle\Service;

use Psr\Log\LoggerInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Doctrine\ORM\EntityManager;
use Acme\CoreBundle\Entity\Athlete;

/**
 * Class Athlete
 *
 * @package Acme\CoreBundle\Service
 */
class AthleteService
{
    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * Athlete constructor.
     *
     * @param EntityManager $entityManager
     * @param LoggerInterface $logger
     */
    public function __construct(EntityManager $entityManager, LoggerInterface $logger)
    {
        $this->logger        = $logger;
        $this->entityManager = $entityManager;
    }

    /**
     * @return Athlete[]
     */
    public function getAthletes()
    {
        return $this->entityManager->getRepository('AcmeCoreBundle:Athlete')->findAll();
    }

    /**
     * @param int $id
     *
     * @return Athlete
     * @throws NotFoundHttpException
     */
    public function getAthleteById($id)
    {
        $athlete = $this->entityManager->getRepository('AcmeCoreBundle:Athlete')->find($id);

        if (!$athlete instanceof Athlete) {
            throw new NotFoundHttpException("Athlete with ID {$id} could not be found");
        }

        return $athlete;
    }

    /**
     * @param Athlete $athlete
     *
     * @throws \Exception
     */
    public function saveAthlete(Athlete $athlete)
    {
        try {
            $this->entityManager->persist($athlete);
            $this->entityManager->flush();
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());

            // Be sure to rethrow exception. It can be caught & handled in the caller
            throw $e;
        }
    }

    /**
     * @param Athlete $athlete
     *
     * @throws \Exception
     */
    public function removeAthlete(Athlete $athlete)
    {
        try {
            $this->entityManager->remove($athlete);
            $this->entityManager->flush();
        } catch (\Exception $e) {
            $this->logger->error("Unable to delete Athlete with id {$athlete->getId()}");

            // Be sure to rethrow exception. It can be caught & handled in the caller
            throw $e;
        }
    }
}