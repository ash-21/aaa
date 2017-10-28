<?php
require 'user_client_profile.php';
require 'strategy_signup.php';

$userName = addslashes($_POST['userName']);
$profession = addslashes($_POST['profession']);
$homeAddress = addslashes($_POST['homeAddress']);
$workAddress = addslashes($_POST['workAddress']);
$email = addslashes($_POST['email']);
$phone = addslashes($_POST['phoneNo']);
$password = $_POST['password'];

$userObject = new user($userName,$profession,$workAddress,$homeAddress,$email,$phone,$password);

$signupObject = new strategy_signup('user');
if($signupObject->signUp($userObject)===TRUE){
	print "<script>
		window.location='index.html';
		</script>";
}
else {
	print "<script>
		window.location='errorSignup.html';
		</script>";
}

$conn->close();

?>

