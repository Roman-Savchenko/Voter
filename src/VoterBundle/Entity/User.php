<?php
namespace VoterBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use FOS\UserBundle\Model\User as BaseUser;

use Symfony\Component\Validator\Constraints as Assert;

use VoterBundle\Entity\Apartment;
use VoterBundle\Entity\House;

/**
 * @ORM\Entity(repositoryClass="VoterBundle\Entity\Repository\UserRepository")
 * @ORM\Table(name="user",
 *  indexes={
 * @ORM\Index(name="apartment_id", columns={"apartment_id"}),
 * @ORM\Index(name="house_id", columns={"house_id"})})
 *  @ORM\HasLifecycleCallbacks()
 **/
class User extends BaseUser
{
    const ROLE_MANAGER = 'ROLE_MANAGER';
    const ROLE_OPERATOR ='ROLE_OPERATOR';
    const ROLE_USER = 'ROLE_USER';
    const ROLE_ADMIN = 'ROLE_ADMIN';

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="area", type="integer")
     */
    protected $area;

    /**
     * @ORM\Column(name="owner", type="smallint")
     */
    protected $owner;

    /**
     * @ORM\Column(name="voter",  type="smallint")
     */
    protected $voter = 0;

    /**
     * @ORM\ManyToOne(targetEntity="VoterBundle\Entity\Apartment",
     *      inversedBy="users"
     * )
     * @ORM\JoinColumn(name="apartment_id", referencedColumnName="id")
     */
    protected $apartment;

    /**
     * @ORM\ManyToOne(targetEntity="VoterBundle\Entity\House",
     *      inversedBy="users"
     * )
     * @ORM\JoinColumn(name="house_id", referencedColumnName="id")
     */
    protected $house;

    /**
     * @var float
     *
     * @ORM\Column(name="percent", type="decimal", precision=12, scale=2, nullable=true)
     */
    protected $percent;

    /**
     * Set area
     *
     * @param integer $area
     * @return User
     */
    public function setArea($area)
    {
        $this->area = $area;

        return $this;
    }

    /**
     * Get area
     *
     * @return integer 
     */
    public function getArea()
    {
        return $this->area;
    }

    /**
     * Set owner
     *
     * @param integer $owner
     * @return User
     */
    public function setOwner($owner)
    {
        $this->owner = $owner;

        return $this;
    }

    /**
     * Get owner
     *
     * @return integer 
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * Set voter
     *
     * @param integer $voter
     * @return User
     */
    public function setVoter($voter)
    {
        $this->voter = $voter;

        return $this;
    }

    /**
     * Get voter
     *
     * @return integer 
     */
    public function getVoter()
    {
        return $this->voter;
    }

    /**
     * Set apartment
     *
     * @param Apartment $apartment
     * @return User
     */
    public function setApartment(Apartment $apartment = null)
    {
        $this->apartment = $apartment;

        return $this;
    }

    /**
     * Get apartment
     *
     * @return \VoterBundle\Entity\Apartment 
     */
    public function getApartment()
    {
        return $this->apartment;
    }

    /**
     * Set house
     *
     * @param House $house
     * @return User
     */
    public function setHouse(House $house = null)
    {
        $this->house = $house;

        return $this;
    }

    /**
     * Get house
     *
     * @return House
     */
    public function getHouse()
    {
        return $this->house;
    }

    /**
     * Set percent
     *
     * @param string $percent
     *
     * @return User
     */
    public function setPercent($percent)
    {
        $this->percent = $percent;

        return $this;
    }

    /**
     * Get percent
     *
     * @return string 
     */
    public function getPercent()
    {
        return $this->percent;
    }
}
