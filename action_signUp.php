<?php
require 'user_client_profile.php';
require 'strategy_signup.php';
require_once('state_pattern.php');

$userName = addslashes($_POST['userName']);
$profession = addslashes($_POST['profession']);
$homeAddress = addslashes($_POST['homeAddress']);
$workAddress = addslashes($_POST['workAddress']);
$email = addslashes($_POST['email']);
$phone = addslashes($_POST['phoneNo']);
$password = $_POST['password'];
$current_state = null ;
$userObject = new user($userName,$profession,$workAddress,$homeAddress,$email,$phone,$password);

$signupObject = new strategy_signup('user');
if($signupObject->signUp($userObject)===TRUE){
	$current_state = new successful_signup;
}
else {
	$current_state = new unsuccessful_signup;
}

$conn->close();

?>

