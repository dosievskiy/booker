<?php

namespace Booker\BookBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;

/**
 * BookingRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class BookingRepository extends EntityRepository
{
    /*
     * return an object with booking for chosen date
     */
    public function getAllBooking($date)
    {
        $date_start = date('Y-m-d 00:00:00', $date);
        $date_end = date('Y-m-d 00:00:00', $date + 24*3600);
        $query = $this->createQueryBuilder('b')
            ->select('b')
            ->where('b.booking_date >= :date_start AND b.booking_date < :date_end')
            ->setParameters(array('date_start' => $date_start, 'date_end' => $date_end));
        
        return  $query->getQuery()->getResult();
    }
    
    /*
     * return an object with existing user's booking in current period for any room
     * and in any period for current room
     */
    public function getBookingByTime($date, $time_start, $room_id, $user_id)
    {
        $date_start = date('Y-m-d H:i:s', $date + $time_start*3600);
        $date_end = date('Y-m-d H:i:s', $date + ($time_start+1)*3600);
        $day_start = date('Y-m-d 00:00:00', $date);
        $day_end = date('Y-m-d 00:00:00', $date+24*3600);
        $query = $this->createQueryBuilder('b')
            ->select('b')
            ->where('b.booking_date >= :date_start AND b.booking_date < :date_end')
            ->orWhere('b.user_id = :user_id AND b.room_id = :room_id AND b.booking_date >= :day_start AND b.booking_date < :day_end')
            ->setParameters(array(
                'date_start' => $date_start, 'date_end' => $date_end,
                'user_id' => $user_id, 'room_id' => $room_id,
                'day_start' => $day_start, 'day_end' => $day_end,
                ))
            ;
        
        return  $query->getQuery()->getResult();
    }
    
}
