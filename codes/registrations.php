<?php

include_once __DIR__ . '/../init.php';

if(isset($_POST["getregisterd"]) and !empty($_POST["getregisterd"])) {//var_dump($_SESSION);die();
   $data['guests'] = $data["subscriptions"] = [];
   if (!isset($_SESSION['ddr_id'])) :
       $data['firstName'] = ucfirst(filter_var($_POST["registration"]["primaryGuest"]["firstName"], FILTER_SANITIZE_STRING));
       $data['lastName'] = ucfirst(filter_var($_POST["registration"]["primaryGuest"]["lastName"], FILTER_SANITIZE_STRING));
       $data['email'] = filter_var($_POST["registration"]["primaryGuest"]["email"], FILTER_SANITIZE_EMAIL);
       $data['zipCode'] = filter_var($_POST["registration"]["primaryGuest"]["zipCode"], FILTER_SANITIZE_STRING);
       $data['noOfGuests'] = (isset($_POST["registration"]["noOfGuests"])) ? filter_var($_POST["registration"]["noOfGuests"], FILTER_VALIDATE_INT) : null;

       if (isset($_POST["registration"]["primaryGuest"]["subscriptions"]) && !empty($_POST["registration"]["primaryGuest"]["subscriptions"])) :
           $data["subscriptions"] = [
               'seasonTicketWaitlist' => (((isset($_POST["registration"]["primaryGuest"]["subscriptions"]["seasonTicketWaitlist"])) && $_POST["registration"]["primaryGuest"]["subscriptions"]["seasonTicketWaitlist"]==1) ? (filter_var($_POST["registration"]["primaryGuest"]["subscriptions"]["seasonTicketWaitlist"], FILTER_VALIDATE_INT)) : 0),
               'womensClub' => (((isset($_POST["registration"]["primaryGuest"]["subscriptions"]["womensClub"])) && $_POST["registration"]["primaryGuest"]["subscriptions"]["womensClub"]==1) ? (filter_var($_POST["registration"]["primaryGuest"]["subscriptions"]["womensClub"], FILTER_VALIDATE_INT)) : 0),
               'offers' => (((isset($_POST["registration"]["primaryGuest"]["subscriptions"]["offers"])) && $_POST["registration"]["primaryGuest"]["subscriptions"]["offers"]==1) ? (filter_var($_POST["registration"]["primaryGuest"]["subscriptions"]["offers"], FILTER_VALIDATE_INT)) : 0),
               'saluteMilitaryAppreciationClub' => (((isset($_POST["registration"]["primaryGuest"]["subscriptions"]["saluteMilitaryAppreciationClub"])) && $_POST["registration"]["primaryGuest"]["subscriptions"]["saluteMilitaryAppreciationClub"]==1) ? (filter_var($_POST["registration"]["primaryGuest"]["subscriptions"]["saluteMilitaryAppreciationClub"], FILTER_VALIDATE_INT)) : 0)
           ];
           foreach ($data["subscriptions"] as $key => $value) :
                if (!$value)
                    unset($data["subscriptions"][$key]);
           endforeach;
       endif;
   endif;

   if (isset($_POST["registration"]["guests"]) && !empty($_POST["registration"]["guests"])) :
       foreach ($_POST["registration"]["guests"] as $key => $value) :
            $_SESSION['guests'][] = $data['guests'][] = ['firstName' => ucfirst(filter_var($value["firstName"], FILTER_SANITIZE_STRING)), 'lastName' => ucfirst(filter_var($value["lastName"], FILTER_SANITIZE_STRING)), 'email' => filter_var($value["email"], FILTER_SANITIZE_EMAIL)];
       endforeach;
   elseif(!isset($_SESSION['guests'])) :
       $_SESSION['guests'] = [];
   endif;
   
   $registrations = new Registrations();
   if ($registrations->create_registrations($data)) :
        header("Location: {$app['URL'][$app['ENV']]}screenshot_2.php");
   endif;
   
}