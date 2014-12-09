<?php

namespace Booker\BookBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="Booker\BookBundle\Entity\Repository\UserRepository")
 * @ORM\Table(name="users")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="Booking", mappedBy="user")
     */
    protected $booking;
    
    public function __construct()
    {
        parent::__construct();
        // your own logic
        $this->booking = new ArrayCollection();
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
     * Add booking
     *
     * @param \Booker\BookBundle\Entity\Booking $booking
     * @return User
     */
    public function addBooking(\Booker\BookBundle\Entity\Booking $booking)
    {
        $this->booking[] = $booking;

        return $this;
    }

    /**
     * Remove booking
     *
     * @param \Booker\BookBundle\Entity\Booking $booking
     */
    public function removeBooking(\Booker\BookBundle\Entity\Booking $booking)
    {
        $this->booking->removeElement($booking);
    }

    /**
     * Get booking
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getBooking()
    {
        return $this->booking;
    }
}
