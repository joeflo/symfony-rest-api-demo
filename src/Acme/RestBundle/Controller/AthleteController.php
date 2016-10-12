<?php

namespace Acme\RestBundle\Controller;

use Acme\CoreBundle\Entity\Athlete;
use Acme\CoreBundle\Form\Type\AthleteType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;

/**
 * Class AthleteController
 *
 * @package Acme\RestBundle\Controller
 */
class AthleteController extends Controller
{
    /**
     * @Rest\View()
     *
     * @return Athlete[]
     */
    public function listAthletesAction()
    {
        return $this->get('flosports.core.service.athlete')->getAthletes();
    }

    /**
     * @Rest\View()
     *
     * @param $id
     *
     * @return Athlete
     */
    public function getAthleteAction($id)
    {
        return $this->get('flosports.core.service.athlete')->getAthleteById($id);
    }

    /**
     * @Rest\View()
     *
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     */
    public function createAthleteAction(Request $request)
    {
        return $this->saveAthlete($request, new Athlete());
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
    public function updateAthleteAction(Request $request, $id)
    {
        $athlete = $this
            ->get('flosports.core.service.athlete')
            ->getAthleteById($id);

        return $this->saveAthlete($request, $athlete);
    }

    /**
     * @param Request $request
     * @param Athlete $athlete
     *
     * @return Athlete|\Symfony\Component\Form\FormInterface
     * @throws \Exception
     */
    private function saveAthlete(Request $request, Athlete $athlete)
    {
        $handler = $this->get('flosports.core.form.handler.form_handler');
        $form    = $handler->processForm($athlete, $request, AthleteType::class);

        if ($form->isValid()) {
            $this->get('flosports.core.service.athlete')->saveAthlete($athlete);
        }

        return ($form->isValid()) ? $athlete : $form;
    }

    /**
     * @param int $athleteId
     */
    public function deleteAthleteAction($athleteId)
    {
    }
}