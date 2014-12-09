<?php

namespace Booker\BookBundle\Entity\Additional;

class BookingConstants {
    /*
     * return array of constant from 'parameters.yml' with the in $vars array
     */
    public static function getBookingConstants($container, $vars)
    {
        $constants = array();
        foreach ($vars as $const_name)
        {
            $constants[$const_name] = $container->getParameter('booking_'.$const_name);
        }
        
        return $constants;
    }
}
