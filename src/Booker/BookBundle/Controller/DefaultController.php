<?php

namespace Booker\BookBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Booker\BookBundle\Entity\Additional\BookingList;
use Booker\BookBundle\Entity\Additional\ValidateBooking;
use Booker\BookBundle\Entity\Additional\ErrorMessage;
use Booker\BookBundle\Entity\Additional\BookingConstants;
use Booker\BookBundle\Entity\DatabaseManager\BookingManager;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $current_user = $this->getUser() ? $this->getUser() : null;
        $date = time();
        
        $em = $this->getDoctrine()->getManager();
        $booking = $em->getRepository('BookerBookBundle:Booking')->getAllBooking($date);
        $booking_sorted = BookingList::getBookingSorted($booking);
        
        $rooms = $em->getRepository('BookerBookBundle:Rooms')->getRooms();
        
        if (!$rooms) {
            throw $this->createNotFoundException('Not found any room in database.');
        }
        
        $constants = BookingConstants::getBookingConstants($this->container, array('time_min', 'time_max', 'time_period'));
        
        return $this->render('BookerBookBundle:Default:index.html.twig', array(
            'current_user' => $current_user,
            'booking' => $booking_sorted,
            'rooms' => $rooms,
            'constants' => $constants
            ));
    }
    
    public function deleteBookingAction()
    {
        $request = $this->container->get('request');
        $id = $request->request->get('id');
        
        $em = $this->getDoctrine()->getManager();
        if (!$book = $em->getRepository('BookerBookBundle:Booking')->find($id))
            return new Response(json_encode(array("success" => false, 
                "error" => ErrorMessage::getMessage('BOOKING_NOT_FOUND'))));
        $em->remove($book);
        $em->flush();
        
        $response = array("success" => true);
        return new Response(json_encode($response));
    }
    
    public function addBookingAction()
    {
        $request = $this->container->get('request');
        $time_start = (int)$request->request->get('time_start');
        $room_id = (int)$request->request->get('room_id');
        $user_id = (int)$request->request->get('user_id');
        $date = strtotime($request->request->get('date'));
        
        if ($error = ValidateBooking::addBookingValuesValidate($this->container, $room_id, $user_id, $time_start, $date))
            return new Response(json_encode(array("success" => false, "error" => $error)));
        
        $em = $this->getDoctrine()->getManager();
        $booking = $em->getRepository('BookerBookBundle:Booking')->getBookingByTime($date, $time_start, $room_id, $user_id);
        
        if ($error = ValidateBooking::checkExistBooking($booking, $room_id, $time_start, $user_id))
            return new Response(json_encode(array("success" => false, "error" => $error)));
        
        $user = $em->getRepository('BookerBookBundle:User')->find($user_id);
        $room = $em->getRepository('BookerBookBundle:Rooms')->find($room_id);
        if ($error = ValidateBooking::foundBookingValuesValidate($room, $user))
            return new Response(json_encode(array("success" => false, "error" => $error)));
        
        $bookingManager = new BookingManager($em);
        $bookingManager->addBooking($user, $room, $date, $time_start);

        $response = array("success" => true);
        return new Response(json_encode($response));
    }
    
    public function selectBookingAction()
    {
        $request = $this->container->get('request');
        
        if (!$date = strtotime($request->request->get('date')))
            return new Response(json_encode(array("success" => false, 
                "error" => ErrorMessage::getMessage('INCORRECT_VALUE', 'date'))));
        
        $em = $this->getDoctrine()->getManager();
        $booking = $em->getRepository('BookerBookBundle:Booking')->getAllBooking($date);
        $booking_sorted = BookingList::getBookingSorted($booking);
        
        $rooms = $em->getRepository('BookerBookBundle:Rooms')->getRooms();
        
        $current_user_id = $this->getUser() ? $this->getUser()->getId() : null;
        
        $constants = BookingConstants::getBookingConstants($this->container, array('time_min', 'time_max', 'time_period'));
        $response = array("success" => true, 'booking' => $booking_sorted,
            'rooms' => $rooms, 'current_user_id' => $current_user_id, 
            'constants' => $constants);
        return new Response(json_encode($response));
    }
    
}
