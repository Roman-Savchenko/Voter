<?php
namespace VoterBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="VoterBundle\Entity\Repository\ApartmentRepository")
 * @ORM\Table(name="apartment")
 *  @ORM\HasLifecycleCallbacks()
 **/
class Apartment
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="apartment_area", type="integer")
     */
    protected $apartmentArea;

    /**
     * @ORM\OneToMany(targetEntity="VoterBundle\Entity\User", mappedBy="apartment")
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
     * Set apartmentArea
     *
     * @param integer $apartmentArea
     * @return Apartment
     */
    public function setApartmentArea($apartmentArea)
    {
        $this->apartmentArea = $apartmentArea;

        return $this;
    }

    /**
     * Get apartmentArea
     *
     * @return integer 
     */
    public function getApartmentArea()
    {
        return $this->apartmentArea;
    }

    /**
     * Add users
     *
     * @param User $users
     * @return Apartment
     */
    public function addUser(User $users)
    {
        $this->users[] = $users;

        return $this;
    }

    /**
     * Remove users
     *
     * @param \VoterBundle\Entity\User $users
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
