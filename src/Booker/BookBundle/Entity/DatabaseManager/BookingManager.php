<?php

namespace Booker\BookBundle\Entity\DatabaseManager;

use Booker\BookBundle\Entity\Booking;

class BookingManager {
    protected $em;
    
    public function __construct(\Doctrine\ORM\EntityManager $em) {
        $this->em = $em;
    }
        
    //insert new booking data in db.
    function addBooking($user, $room, $date, $time_start)
    {
        $new_booking = new Booking();
        $new_booking->setUser($user);
        $new_booking->setRoom($room);
        $new_booking->setBookingDate(date('Y-m-d H:i:s', $date + $time_start*3600));

        $this->em->persist($new_booking);
        $this->em->flush();
    }
}