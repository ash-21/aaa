/**
 * Gets information to check sucessful log-in of user or else redirect it
 * @author    Sayeed Md Ashraful Islam 	Roll : 48
 * @author query    Mahfida Jerin 	Roll : 26
 */
<?php
session_start();
require_once('singleton_database.php');
require_once('iterator_table.php');
require_once('state_pattern.php');
require_once('page_decorator.php');


$header_decorator_object = new header_decorator;
$body_decorator_object = new login_body_decorator;
$tail_decorator_object = new login_tail_decorator;
$redirect = FALSE;

$database_object = singleton_database::getInstance();
$conn = $database_object->getDatabase();

if(isset($_SESSION['userID'])){
	$email_userID = $_SESSION['userID'];
	$redirect = TRUE;
}
else {
	$email_userID = addslashes($_POST['email_userID']);
	$password = addslashes($_POST['password']);
}

$current_state = new not_logged_in;

$query = <<<SQL
select *
from users
where email = '{$email_userID}' or userID = '{$email_userID}'
SQL;

if ($result= $conn->query($query))
{
	$row = $result->fetch_assoc();
	if($row){
		if($redirect===TRUE) $current_state = new user_logged_in($row);
		else if(((strlen($password) == 0) && is_null($row['password'])) || (password_verify($password,$row['password']))) {
			$_SESSION['userID'] = $row['userID'];
			$current_state = new user_logged_in($row);
		}
		else $current_state = new wrong_password;
	}
	else $current_state = new wrong_email;
	$result->free();
} else {
	$current_state = new database_error;
}

$page = null;
$header_decorator_object->set_state($current_state);
$page = $body_decorator_object->decorate_page($header_decorator_object->decorate_page($page).$current_state->show_page());

$query2 = <<<SQL
select *
from appointments as a,clients as c 
where a.userID = '{$row['userID']}' and 
a.clientID = c.clientID and 
appointmentTime between date_sub(now(),interval 1 hour) and date_add(now(),interval 1 day)
order by appointmentTime
SQL;

$page .= "<p>Today</p>";

if ($result= $conn->query($query2))
{
	$table_decorator_object = new profile_table_builder('user',$result);
	$page .= $table_decorator_object->get_page();
	$result->free();
}
$query3 = <<<SQL
select *
from appointments as a,clients as c 
where a.userID = '{$row['userID']}' and 
a.clientID = c.clientID and 
appointmentTime > date_add(now(),interval 1 day)
order by appointmentTime
SQL;
$page .= "<p>Future</p>";

if ($result= $conn->query($query3))
{
	$table_decorator_object = new profile_table_builder('user',$result);
	$page .= $table_decorator_object->get_page();
	$result->free();
}

$conn->close();
$page = $tail_decorator_object->decorate_page($page);
echo "{$page}";
?>
