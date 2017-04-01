<?php

namespace VoterBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Response;

use VoterBundle\Entity\User;

class AjaxController extends Controller
{
    /**
     * @Route("/stop", name="voter_stop")
     * @param Request $request
     *
     * @return Response
     */
    public function stopAction(Request $request)
    {
        try {
            $result = $this->get('voter.manager')->setVoterResultData($this->getUser());
        } catch (\Exception $e) {
            $result = $e->getMessage();
        }

        return new JsonResponse(['status' => $result]);

    }

    /**
     * @Route("/result", name="voter_result")
     * @param Request $request
     *
     * @return Response
     */
    public function resultAction(Request $request)
    {
        try {
            $result = $this->get('voter.manager')->getResultVoter($this->getUser());
            if ($result > 50) {
                $response = $this->get('translator')->trans('form.result_valid_print');
            } else {
                $response = $this->get('translator')->trans('form.result_not_valid_print');
            }
        } catch (\Exception $e) {
            $response = $e->getMessage();
        }

        return new JsonResponse(['status' => $response]);

    }

    /**
     * @Route("/submit", name="voter_form_submit")
     * @param Request $request
     *
     * @return Response
     */
    public function submitAction(Request $request)
    {
        /** @var User $user */
        $user = $this->getUser();
        if ($user->getHouse()->getVoterResult() == 1) {
            return new JsonResponse(['status' => $this->get('translator')->trans('form.stop_voter')]);

        } else if ($user->getOwner() == 0 || $user->getVoter() == 1) {

            return new JsonResponse(['status' => $this->get('translator')->trans('form.result_error')]);
        } else {
            $this->container->get('voter.create')->voterCreate($request, $this->getUser());

            return new JsonResponse(['status' => $this->get('translator')->trans('form.result_voter')]);
        }


    }

}