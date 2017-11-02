<?php
session_start();
require_once('factory_page.php');
require_once('singleton_database.php');
require_once('iterator_table.php');
require_once('state_pattern.php');

$header_factory_object = new header_factory;
$body_factory_object = new login_body_factory;
$tail_factory_object = new login_tail_factory;
$redirect = FALSE;

$database_object = singleton_database::getInstance();
$conn = $database_object->getDatabase();

if(isset($_SESSION['clientID'])){
	$email_userID = $_SESSION['clientID'];
	$redirect = TRUE;
}
else $email_userID = addslashes($_POST['email_userID']);
$password = addslashes($_POST['password']);

$current_state = new not_logged_in;

$query = <<<SQL
select *
from clients
where email = '{$email_userID}' or clientID = '{$email_userID}'
SQL;

if ($result= $conn->query($query))
{
	$row = $result->fetch_assoc();
	if($row){
		if($redirect===TRUE) $current_state = new client_logged_in($row);
		else if(((strlen($password) == 0) && is_null($row['password'])) || (password_verify($password,$row['password']))) {
			$_SESSION['clientID'] = $row['clientID'];
			$current_state = new client_logged_in($row);
		}
		else $current_state = new wrong_password;
	}
	else $current_state = new wrong_email;
	$result->free();
} else {
	$current_state = new database_error;
}

$page = null;
$page = $header_factory_object->print_page($current_state);
$page .= $current_state->show_page();
$page .= $body_factory_object->print_page($current_state);
echo "{$page}";

$query2 = <<<SQL
select name,email,appointmentTime,description,appointmentID,clientID
from appointments as a,users as u 
where a.clientID = '{$row['clientID']}' and 
a.userID = u.userID and 
appointmentTime between date_sub(now(),interval 1 hour) and date_add(now(),interval 1 day)
order by appointmentTime
SQL;
print "<p>Today</p>";

if ($result= $conn->query($query2))
{
	$table_builder_object = new profile_table_builder('client',$result);
	$result->free();
}

$query3 = <<<SQL
select name,email,appointmentTime,description,appointmentID,clientID
from appointments as a,users as u 
where a.clientID = '{$row['clientID']}' and 
a.userID = u.userID and 
appointmentTime > now()
order by appointmentTime
SQL;

print "<p>Future</p>";

if ($result= $conn->query($query3))
{
	$table_builder_object = new profile_table_builder('client',$result);
	$result->free();
}
$conn->close();
$page = $tail_factory_object->print_page($current_state);
echo "{$page}";
?>
