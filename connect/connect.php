<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "clearance_system_db";


// $servername = "localhost";
// $username = "u765170597_group6";
// $password = "iVA5=n?2";
// $dbname = "u765170597_group6";

//Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
//Check connection
if ($conn->connect_error) {
  die("Connection Error: " . $conn->connect_error);
}


      date_default_timezone_set('Asia/Manila');

      $datestamp = date("Y-m-d");
      $timestamp = date("H:i:s");

      $date_time = date("Y-m-d H:i:s");
      $timestamp2 = date("H:i a");
      $day=date('l');
      $day_num=date('d');
      $month=date('M');
      $year=date('Y');

      $date_now = date("d/m/Y");

      $today_str = strtotime(date("Y-m-d H:i:s"));

     

function age($currentage){

  //date in mm/dd/yyyy format; or it can be in other formats as well
  $birthDate = date_format(date_create($currentage),"m/d/Y");
  //explode the date to get month, day and year
  $birthDate = explode("/", $birthDate);
  //get age from date or birthdate
  $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
    ? ((date("Y") - $birthDate[2]) - 1)
    : (date("Y") - $birthDate[2]));
  echo $age;
}

?>