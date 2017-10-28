<?php
require 'user_client_profile.php';
require 'strategy_signup.php';
require_once('state_pattern.php');

$userName = addslashes($_POST['userName']);
$email = addslashes($_POST['email']);
$phone = addslashes($_POST['phoneNo']);
$password = $_POST['password'];

$clientObject = new client($userName,$email,$phone,$password);
$current_state = null ;
$signupObject = new strategy_signup('client');
if($signupObject->signUp($clientObject)===TRUE){
	$current_state = new successful_signup;
}
else {
	$current_state = new unsuccessful_signup;	
}
$conn->close();
?>

