<?php

namespace Booker\BookBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Booker\BookBundle\Entity\Repository\BookingRepository")
 * @ORM\Table(name="booking")
 * @ORM\HasLifecycleCallbacks()
 */
class Booking
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\Column(type="integer")
     *
     */
    protected $user_id;
    
    /**
     * @ORM\Column(type="integer")
     *
     */
    protected $room_id;
    
    /**
     * @ORM\Column(type="string", length=20)
     */
    protected $booking_date;
    
   /**
     * @ORM\ManyToOne(targetEntity="Rooms", inversedBy="booking")
     * @ORM\JoinColumn(name="room_id", referencedColumnName="id")
     */
    protected $room;
    
    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="booking")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;
    
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
     * Set user_id
     *
     * @param integer $userId
     * @return Booking
     */
    public function setUserId($userId)
    {
        $this->user_id = $userId;

        return $this;
    }

    /**
     * Get user_id
     *
     * @return integer 
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * Set room_id
     *
     * @param integer $roomId
     * @return Booking
     */
    public function setRoomId($roomId)
    {
        $this->room_id = $roomId;

        return $this;
    }

    /**
     * Get room_id
     *
     * @return integer 
     */
    public function getRoomId()
    {
        return $this->room_id;
    }

    /**
     * Set booking_date
     *
     * @param \DateTime $bookingDate
     * @return Booking
     */
    public function setBookingDate($bookingDate)
    {
        $this->booking_date = $bookingDate;

        return $this;
    }

    /**
     * Get booking_date
     *
     * @return \DateTime 
     */
    public function getBookingDate()
    {
        return $this->booking_date;
    }




    /**
     * Set room
     *
     * @param \Booker\BookBundle\Entity\Rooms $room
     * @return Booking
     */
    public function setRoom(\Booker\BookBundle\Entity\Rooms $room = null)
    {
        $this->room = $room;

        return $this;
    }

    /**
     * Get room
     *
     * @return \Booker\BookBundle\Entity\Rooms 
     */
    public function getRoom()
    {
        return $this->room;
    }

    /**
     * Set user
     *
     * @param \Booker\BookBundle\Entity\User $user
     * @return Booking
     */
    public function setUser(\Booker\BookBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Booker\BookBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

}
