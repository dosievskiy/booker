<?php
namespace Booker\BookBundle\Entity\Additional;

class ErrorMessage {
    const ALREADY_BOOKED_BY_USER = "You have already booked this room for this period. PLease, refresh the page.";
    const ALREADY_BOOKED_BY_SOMEONE = "Sorry, someone has already booked this room for this period. PLease, refresh the page.";
    const ALREADY_BOOKED_FOR_PERIOD = "You have already booked room '%VALUE%' for this period.";
    const ALREADY_BOOKED_FOR_ANOTHER_PERIOD = "You have already booked this room for another period.";
    const BOOKING_NOT_FOUND = "Booking not found.";
    const INCORRECT_VALUE = "Incorrect value of field '%VALUE%'";
    const BOOKING_TO_PAST = "You cann't booking to past period.";
    
    public static function getMessage($const, $replacement = '')
    {
        return str_replace('%VALUE%', $replacement, constant('self::'.$const));
    }
}

