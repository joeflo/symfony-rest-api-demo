<?php

namespace Acme\CoreBundle\Service;

use Psr\Log\LoggerInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Doctrine\ORM\EntityManager;
use Acme\CoreBundle\Entity\Team;

/**
 * Class Team
 *
 * @package Acme\CoreBundle\Service
 */
class TeamService
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
     * Team constructor.
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
     * @return Team[]
     */
    public function getTeams()
    {
        return $this->entityManager->getRepository('AcmeCoreBundle:Team')->findAll();
    }

    /**
     * @param int $id
     *
     * @return Team
     * @throws NotFoundHttpException
     */
    public function getTeamById($id)
    {
        $team = $this->entityManager->getRepository('AcmeCoreBundle:Team')->find($id);

        if (!$team instanceof Team) {
            throw new NotFoundHttpException("Team with ID {$id} could not be found");
        }

        return $team;
    }

    /**
     * @param Team $team
     *
     * @throws \Exception
     */
    public function saveTeam(Team $team)
    {
        try {
            $this->entityManager->persist($team);
            $this->entityManager->flush();
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());

            // Be sure to rethrow exception. It can be caught & handled in the caller
            throw $e;
        }
    }

    /**
     * @param Team $team
     *
     * @throws \Exception
     */
    public function removeTeam(Team $team)
    {
        try {
            $this->entityManager->remove($team);
            $this->entityManager->flush();
        } catch (\Exception $e) {
            $this->logger->error("Unable to delete Team with id {$team->getId()}");

            // Be sure to rethrow exception. It can be caught & handled in the caller
            throw $e;
        }
    }
}