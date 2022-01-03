<?php
 require_once "Mail.php";
 
 $from = "Ash <ash@callitme.com>";
 $to = "Ash <shrivastavashutosh@gmail.com>";
 $subject = "Hi!";
 $body = "Hi,\n\nHow are you?";
 
 $host = "email-smtp.us-west-2.amazonaws.com";
 $port = "587";
 $username = "AKIAJ2RT7GFLTKANREXA";
 $password = "ArpmGEy9UNoxqmPZ0RVtMyrWxUN1dSuRTseucn9d3Zb6";
 
 $headers = array ('From' => $from,
   'To' => $to,
   'Subject' => $subject);
 $smtp = Mail::factory('smtp',
   array ('host' => $host,
     'port' => $port,
     'auth' => true,
     'username' => $username,
     'password' => $password));