<?php

namespace VoterBundle\Managers;

use Doctrine\Bundle\DoctrineBundle\Registry;

use VoterBundle\Entity\User;
use VoterBundle\Entity\House;

class VoterManager {

    /** @var Registry */
    protected $doctrine;

    public function __construct(Registry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    public function setVoterResult(User $user)
    {
        $house = $this->getHouse($user);
        $this->setUserData($house, $user);


    }

    /**
     * @param User $user
     *
     * @return object House
     */
    protected function getHouse(User $user)
    {
        $house = $this->doctrine->getRepository("VoterBundle:House")->find($user->getHouse());

        return $house;
    }

    /**
     * @param House $house
     * @param User $user
     */
    protected function setUserData(House $house, User $user)
    {
        $apartmentPercent = ($user->getArea() / $house->getSumArea()) * 100;
        $user->setPercent($apartmentPercent);
        $user->setVoter(1);
        $em = $this->doctrine->getManager();
        $em->persist($user);
        $em->flush();
    }

    /**
     * @param User $user
     *
     * @return string
     */
    public function setVoterResultData(User $user)
    {
        /** @var House $house */
        $house = $this->getHouse($user);
        $house->setVoterResult(1);
        $em = $this->doctrine->getManager();
        $em->persist($house);
        $em->flush();

        return "";
    }

    /**
     * @param User $user
     *
     * @return number
     */
    public function getResultVoter(User $user)
    {
        $percent = [];
        $users = $this
            ->doctrine
            ->getRepository("VoterBundle:User")
            ->findBy(
                [
                  'house' => $user->getHouse()
                ]
            );
        /** @var User $value */
        foreach ($users as $value) {
            $percent[] = $value->getPercent();
        }
        $result = array_sum($percent);

        return $result;
    }
}