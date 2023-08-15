<?php
require("connect.php");

if($_SERVER["REQUEST_METHOD"]=="POST"){
$data=json_decode(file_get_contents("php://input"),true);

$userFname=$data['fname'];
$userLname=$data['lname'];
$userEmail=$data['email'];
$userPassword=$data['Password'];
$userConfirmpassword =$data['confirm password'];
$userBirth=$data['birth'];
$userMobile=$data['mobile'];


$sql="INSERT INTO mean VALUES('$userFname','$userLname','$userEmail','$userPassword','$userConfirmpassword','$userBirth','$userMobile')";

$response= array();
if($conn->query($sql) === True){
    $response['message']="Data stored successfully";
}else{
    $response['message']="Error: ".$sql."<br>.$conn->error";

}
echo json_encode($response);
}
$conn->close();
?>