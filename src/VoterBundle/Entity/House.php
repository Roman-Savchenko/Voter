<?php

namespace VoterBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="VoterBundle\Entity\Repository\HouseRepository")
 * @ORM\Table(name="house")
 *  @ORM\HasLifecycleCallbacks()
 **/
class House
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="sum_area", type="integer")
     */
    protected $sumArea;

    /**
     * @ORM\Column(name="voter_result", type="integer")
     */
    protected $voterResult;

    /**
     * @ORM\OneToMany(targetEntity="VoterBundle\Entity\User", mappedBy="house")
     */
    protected $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set sumArea
     *
     * @param integer $sumArea
     * @return House
     */
    public function setSumArea($sumArea)
    {
        $this->sumArea = $sumArea;

        return $this;
    }

    /**
     * Get sumArea
     *
     * @return integer 
     */
    public function getSumArea()
    {
        return $this->sumArea;
    }

    /**
     * Set voterResult
     *
     * @param integer $voterResult
     * @return House
     */
    public function setVoterResult($voterResult)
    {
        $this->voterResult = $voterResult;

        return $this;
    }

    /**
     * Get voterResult
     *
     * @return integer 
     */
    public function getVoterResult()
    {
        return $this->voterResult;
    }

    /**
     * Add users
     *
     * @param User $users
     * @return House
     */
    public function addUser(User $users)
    {
        $this->users[] = $users;

        return $this;
    }

    /**
     * Remove users
     *
     * @param User $users
     */
    public function removeUser(User $users)
    {
        $this->users->removeElement($users);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUsers()
    {
        return $this->users;
    }
}
