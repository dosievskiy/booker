<?php

namespace Booker\BookBundle\Entity\Additional;

class BookingList {
    /*
     * return array of booking grouped by room. each room - is array with key
     * 'booking time start' and values: booking id, username and user id.
     */
    public static function getBookingSorted($input)
    {
        $output = array();
        foreach ($input as $row)
        {
            $output[$row->getRoomId()][date('G', strtotime($row->getBookingDate()))] =
                array(
                    'id' => $row->getId(),
                    'user_id' =>$row->getUserId(),
                    'user_name' =>$row->getUser()->getUserName()
                );
        }
        return $output;
    }
}
