<?php

require_once('singleton_database.php');

$database_object = singleton_database::getInstance();
$conn = $database_object->getDatabase();

$clientID = addslashes($_POST['clientID']);
$userID = addslashes($_POST['userID']);
$description = addslashes($_POST['description']);
$date =  $_POST['Date'];

$timestamp = strtotime($date);
$converted_date = date("Y-m-d H:i:s", $timestamp);

while(TRUE){
$start = <<<SQL
SELECT * FROM appointments WHERE appointmentTime between DATE_SUB('{$converted_date}', INTERVAL 1 HOUR) and DATE_ADD('{$converted_date}', INTERVAL 1 HOUR) and userID = '{$userID}';
SQL;
if($result = $conn->query($start)) {
	$row_cnt = $result->num_rows;
	if($row_cnt>0){
		$converted_date = date("Y-m-d H:i:s", strtotime($converted_date)+3600);
		var_dump($converted_date);
		echo "$row_cnt<br>";
	} else {
		break;
	}
}

}

$query = <<<SQL
INSERT INTO appointments (userID,clientID,description,appointmentTime) VALUES('{$userID}','{$clientID}','{$description}','{$converted_date}')
SQL;

if ($conn->query($query) === TRUE){
	$_SESSION['clientID'] = $clientID;
	header("location:action_login_client.php");
}

?>
