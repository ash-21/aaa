<?php

require_once('singleton_database.php');

$database_object = singleton_database::getInstance();
$conn = $database_object->getDatabase();

$clientID = addslashes($_POST['clientID']);
$userID = addslashes($_POST['userID']);
$description = $_POST['description'];
$password = null;

$query = <<<SQL
INSERT INTO appointments (userID,clientID,description) VALUES('{$userID}','{$clientID}','{$description}');
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
	$_SESSION['password'] = $password;
	header("location:action_login_client.php");
}
?>
