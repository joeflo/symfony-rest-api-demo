<?php

namespace Acme\RestBundle\Controller;

use Acme\CoreBundle\Entity\Team;
use Acme\CoreBundle\Form\Type\TeamType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;

/**
 * Class TeamController
 *
 * @package Acme\RestBundle\Controller
 */
class TeamController extends Controller
{
    /**
     * @Rest\View()
     *
     * @return Team[]
     */
    public function listTeamsAction()
    {
        return $this->get('flosports.core.service.team')->getTeams();
    }

    /**
     * @Rest\View()
     *
     * @param $id
     *
     * @return Team
     */
    public function getTeamAction($id)
    {
        return $this->get('flosports.core.service.team')->getTeamById($id);
    }

    /**
     * @Rest\View()
     *
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     */
    public function createTeamAction(Request $request)
    {
        return $this->saveTeam($request, new Team());
    }

    /**
     * @Rest\View()
     *
     * @param Request $request
     * @param int $id
     *
     * @return Response
     * @throws \Exception
     */
    public function updateTeamAction(Request $request, $id)
    {
        $team = $this
            ->get('flosports.core.service.team')
            ->getTeamById($id);

        return $this->saveTeam($request, $team);
    }

    /**
     * @param Request $request
     * @param Team $team
     *
     * @return Team|\Symfony\Component\Form\FormInterface
     * @throws \Exception
     */
    private function saveTeam(Request $request, Team $team)
    {
        $handler = $this->get('flosports.core.form.handler.form_handler');
        $form    = $handler->processForm($team, $request, TeamType::class);

        if ($form->isValid()) {
            $this->get('flosports.core.service.team')->saveTeam($team);
        }

        return ($form->isValid()) ? $team : $form;
    }

    /**
     * @param int $teamId
     */
    public function deleteTeamAction($teamId)
    {
    }
}