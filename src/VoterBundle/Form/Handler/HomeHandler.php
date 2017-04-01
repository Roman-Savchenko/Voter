<?php

namespace VoterBundle\Form\Handler;

use Doctrine\Bundle\DoctrineBundle\Registry;

use Symfony\Component\Form\FormFactory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormInterface;

use VoterBundle\Entity\User;
use VoterBundle\Managers\VoterManager;

class HomeHandler
{
    /** @var FormFactory */
    protected $FormFactory;

    /** @var Registry */
    protected $doctrine;

    /** @var  VoterManager */
    protected $voterManager;

    /**
     * @param FormFactory $FormFactory
     * @param Registry $doctrine
     */
    public function __construct(FormFactory $FormFactory, Registry $doctrine, VoterManager $voterManager)
    {
        $this->FormFactory = $FormFactory;
        $this->doctrine = $doctrine;
        $this->voterManager = $voterManager;
    }

    /**
     * @param Request $request
     * @param User $user
     * @return bool|Form|FormInterface
     */
    public function voterCreate (Request $request, $user)
    {
        $form = $this->FormFactory->create('form_voter', null);
        if ($request->getMethod() === 'POST') {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $this->voterManager->setVoterResult($user);
                return true;
            }
        }

        return $form;
    }
}