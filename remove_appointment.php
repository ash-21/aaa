<?php
/**
 * Shows this page when there is an error in logging in 
 * @author    Sayeed Md Ashraful Islam 	Roll : 48
 */
 
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

//if delete button was pressed
if(isset($_POST['delete'])){
	$query = <<<SQL
	DELETE FROM appointments where appointmentID = '{$appointmentID}';
SQL;
	$conn->query($query);
}


/**
 * Moves the appointment up or down
 * @author    Md Sakib Anwar 	Roll : 16
 */
//if the up button was pressed
else if(isset($_POST['up'])){
	if(strlen($_POST['prev_appointment'])!=0){
		$query = <<<SQL
		SELECT *  FROM appointments where appointmentID = '{$_POST['prev_appointment']}';
SQL;
		$prev_row = $conn->query($query)->fetch_assoc();
		echo "<br>('{$prev_row['userID']}','{$prev_row['clientID']}','{$prev_row['appointmentTime']}','{$prev_row['description']}','{$prev_row['appointmentID']}')<br>";

		$query = <<<SQL
		SELECT *  FROM appointments where appointmentID = '{$appointmentID}';
SQL;
		$current_row = $conn->query($query)->fetch_assoc();
		echo "<br>('{$current_row['userID']}','{$current_row['clientID']}','{$current_row['appointmentTime']}','{$current_row['description']}','{$current_row['appointmentID']}')</br>";

		$temp = $prev_row['appointmentTime'];
		$prev_row['appointmentTime'] = $current_row['appointmentTime'];
		$current_row['appointmentTime'] = $temp;

		$query = <<<SQL
		DELETE FROM appointments where appointmentID = '{$appointmentID}' or appointmentID = '{$_POST['prev_appointment']}';
SQL;
		if($conn->query($query)) echo "done";
		else echo "not done";

		echo "<br>('{$prev_row['userID']}','{$prev_row['clientID']}','{$prev_row['appointmentTime']}','{$prev_row['description']}','{$prev_row['appointmentID']}')<br>";
		echo "<br>('{$current_row['userID']}','{$current_row['clientID']}','{$current_row['appointmentTime']}','{$current_row['description']}','{$current_row['appointmentID']}')</br>";

		$query = <<<SQL
		INSERT INTO appointments 
		VALUES 
		('{$prev_row['userID']}','{$prev_row['clientID']}','{$prev_row['appointmentTime']}','{$prev_row['description']}','{$prev_row['appointmentID']}'),
		('{$current_row['userID']}','{$current_row['clientID']}','{$current_row['appointmentTime']}','{$current_row['description']}','{$current_row['appointmentID']}');
SQL;
		$conn->query($query);
	}
}

//if the down button was pressed
else{
	if(strlen($_POST['next_appointment'])!=0){
		$query = <<<SQL
		SELECT *  FROM appointments where appointmentID = '{$_POST['next_appointment']}';
SQL;
		$next_row = $conn->query($query)->fetch_assoc();

		$query = <<<SQL
		SELECT *  FROM appointments where appointmentID = '{$appointmentID}';
SQL;
		$current_row = $conn->query($query)->fetch_assoc();
		echo "<br>('{$current_row['userID']}','{$current_row['clientID']}','{$current_row['appointmentTime']}','{$current_row['description']}','{$current_row['appointmentID']}')</br>";

		$temp = $next_row['appointmentTime'];
		$next_row['appointmentTime'] = $current_row['appointmentTime'];
		$current_row['appointmentTime'] = $temp;

		$query = <<<SQL
		DELETE FROM appointments where appointmentID = '{$appointmentID}' or appointmentID = '{$_POST['next_appointment']}';
SQL;
		if($conn->query($query)) echo "done";
		else echo "not done";

		$query = <<<SQL
		INSERT INTO appointments 
		VALUES 
		('{$next_row['userID']}','{$next_row['clientID']}','{$next_row['appointmentTime']}','{$next_row['description']}','{$next_row['appointmentID']}'),
		('{$current_row['userID']}','{$current_row['clientID']}','{$current_row['appointmentTime']}','{$current_row['description']}','{$current_row['appointmentID']}');
SQL;
		$conn->query($query);
	}
}

//redirect to original page
if($user===TRUE){
	$_SESSION['userID'] = $userID;
	header("location:action_login.php");
}
else{
	$_SESSION['clientID'] = $clientID;
	header("location:action_login_client.php");
}

?>
