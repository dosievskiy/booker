<?php

namespace Booker\BookBundle\Entity\Additional;

class ValidateBooking {
    /*
     * validate incomming variables when add booking.
     * return error message if any error was found or empty string otherwise.
     */
    public static function addBookingValuesValidate($container, $room_id, $user_id, $time_start, $date)
    {
        $error = '';
        if ( ($time_start < $container->getParameter('booking_time_min'))
            || ($time_start > $container->getParameter('booking_time_max')) )
        {
            $error = ErrorMessage::getMessage('INCORRECT_VALUE', 'time_start'); 
        }
        if (!$date)
            $error = ErrorMessage::getMessage('INCORRECT_VALUE', 'date'); 
        if (!$room_id)
            $error = ErrorMessage::getMessage('INCORRECT_VALUE', 'room_id'); 
        if (!$user_id)
            $error = ErrorMessage::getMessage('INCORRECT_VALUE', 'user_id'); 
        if ( ($date + ($time_start+1)*3600) < time())
            $error = ErrorMessage::getMessage('BOOKING_TO_PAST'); 
        return $error;
    }
    
    /*
     * check existing user's booking in current period for any room
     * and in any period for current room
     * return error message if any error was found or empty string otherwise.
     */
    public static function checkExistBooking($booking, $room_id, $time_start, $user_id)
    {
        $error = '';
        foreach ($booking as $row)
        {
            $booked_time = date('G', strtotime($row->getBookingDate()));
            if ( ($row->getRoomId() == $room_id) && ($booked_time == $time_start) )
            {
                if ($row->getUserId() == $user_id) {
                    $error = ErrorMessage::getMessage('ALREADY_BOOKED_BY_USER');
                    break;
                } else {
                    $error = ErrorMessage::getMessage('ALREADY_BOOKED_BY_SOMEONE');
                    break;
                }
            }
            if ( ($booked_time == $time_start) && ($row->getRoomId() != $room_id) && ($row->getUserId() == $user_id) )
            {
                $error = ErrorMessage::getMessage('ALREADY_BOOKED_FOR_PERIOD', $row->getRoom()->getName());
                break;
            }
            if ( ($booked_time != $time_start) && ($row->getRoomId() == $room_id) && ($row->getUserId() == $user_id) )
            {
                $error = ErrorMessage::getMessage('ALREADY_BOOKED_FOR_ANOTHER_PERIOD');
                break;
            }
        }
        return $error;
    }
    
    /*
     * check for exist in database room and user id for adding booking
     * return error message if any error was found or empty string otherwise.
     */
    public static function foundBookingValuesValidate($room, $user)
    {
        $error = '';
        if (!$room)
            $error = ErrorMessage::getMessage('INCORRECT_VALUE', 'room_id'); 
        if (!$user)
            $error = ErrorMessage::getMessage('INCORRECT_VALUE', 'user_id'); 
        
        return $error;
    }
}
