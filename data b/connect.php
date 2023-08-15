<?php
$serverName= "localhost";
$userName= "root";
$password= "";
$dbName= "test";


$conn = new mysqli($serverName , $userName , $password , $dbName);
if($conn->connect_error){
    die("Connection Faild: ".$conn->connect_error);
}

?>