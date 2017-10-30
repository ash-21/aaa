<?php
session_start();
require_once('singleton_database.php');

$database_object = singleton_database::getInstance();
$conn = $database_object->getDatabase();
$user = FALSE;

$appointmentID = $_POST['appointmentID'];
if(isset($_POST['clientID']) && !empty($_POST['clientID'])) {
	$clientID = $_POST['clientID'];
}
else if(isset($_POST['userID'])) {
	$userID = $_POST['userID'];
	$user = TRUE;	
} 

$query = <<<SQL
DELETE FROM appointments where appointmentID = '{$appointmentID}';
SQL;

if ($conn->query($query) === TRUE){
	if($user===TRUE){
		$_SESSION['userID'] = $userID;
		echo "{$userID}";
		header("location:action_login_client.php");
	}
	else{
		$_SESSION['clientID'] = $clientID;
		header("location:action_login_client.php");
	}
}

?>
