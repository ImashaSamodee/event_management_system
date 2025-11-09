<?php

$host = "localhost";
$user = "root";
$pass = "";
$db = "23it0527_event_management";

$conn = new mysqli($host,$user,$pass,$db);
if($conn->connect_error){
    echo "Failed to connect DB".$conn->connect_error;
}

?>