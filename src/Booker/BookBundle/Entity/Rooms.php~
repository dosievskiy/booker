<?php

namespace Booker\BookBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="Booker\BookBundle\Entity\Repository\RoomsRepository")
 * @ORM\Table(name="rooms")
 */
class Rooms
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\Column(type="string", length=50)
     */
    protected $name;

    /**
     * @ORM\OneToMany(targetEntity="Booking", mappedBy="room")
     */
    protected $booking;

    public function __construct()
    {
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
     * Set name
     *
     * @param string $name
     * @return Rooms
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Add booking
     *
     * @param \Booker\BookBundle\Entity\Booking $booking
     * @return Rooms
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
