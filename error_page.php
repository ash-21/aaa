<?php
require_once('factory_page.php');

$wrong_value = $_GET['name'];

$error_header_factory_object = new error_header_factory;
$error_footer_factory_object = new error_footer_factory;

$error_header_factory_object->print_page();

if(strcmp($wrong_value, "email") == 0){
	print"
		<h1 style=\"color:red;font-size:300%;text-align:center;\">Sorry, This email address has not been used to sign up yet.</h1>
		<h1 style=\"color:red;font-size:300%;text-align:center;\">Please, sign-up first.</h1> ";
} else if(strcmp($wrong_value, "password") == 0){
	print"
		<h1 style=\"color:red;font-size:300%;text-align:center;\">Sorry, You have entered a wrong password.</h1>
		<h1 style=\"color:red;font-size:300%;text-align:center;\">Please, try logging in with correct password.</h1> ";
} else if(strcmp($wrong_value, "signup") == 0){
	print"
		<h1 style=\"color:red;font-size:300%;text-align:center;\">Sorry, This email address is already used by another user / client.</h1>
		<h1 style=\"color:red;font-size:300%;text-align:center;\">Please, sign-up using another email address.</h1> ";
} else if(strcmp($wrong_value, "database") == 0){
	print"
		<h1 style=\"color:red;font-size:300%;text-align:center;\">Sorry, There was a problem connecting to the database.</h1>
		<h1 style=\"color:red;font-size:300%;text-align:center;\">Please, try again later.</h1> ";
}

$error_footer_factory_object->print_page();

?>
