<?php
require 'user_client_profile.php';
require 'strategy_signup.php';

$userName = addslashes($_POST['userName']);
$email = addslashes($_POST['email']);
$phone = addslashes($_POST['phoneNo']);
$password = $_POST['password'];

$clientObject = new client($userName,$email,$phone,$password);
$signupObject = new strategy_signup('client');
if($signupObject->signUp($clientObject)===TRUE){
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

