<?php
require_once('singleton_database.php');

$database_object = singleton_database::getInstance();
$conn = $database_object->getDatabase();

$appointmentID = $_POST['appointmentID'];
$clientID = $_POST['ID'];

$query = <<<SQL
DELETE FROM appointments where appointmentID = '{$appointmentID}';
SQL;

if ($conn->query($query) === TRUE){
	$query2 = <<<SQL
	select *
	from clients
	where clientID = '{$clientID}'
SQL;

	if ($result= $conn->query($query2)){
		$row = $result->fetch_assoc();
		$password = $row['password'];
	}

	$_SESSION['clientID'] = $clientID;
	header("location:action_login_client.php");
}
?>
