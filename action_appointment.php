<?php

require_once('singleton_database.php');

$database_object = singleton_database::getInstance();
$conn = $database_object->getDatabase();

$clientID = addslashes($_POST['clientID']);
$userID = addslashes($_POST['userID']);
$description = addslashes($_POST['description']);

$query = <<<SQL
INSERT INTO appointments (userID,clientID,description) VALUES('{$userID}','{$clientID}','{$description}')
SQL;

if ($conn->query($query) === TRUE){
	$_SESSION['clientID'] = $clientID;
	header("location:action_login_client.php");
}

?>
