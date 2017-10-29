<?php
require_once('factory_page.php');
require_once('singleton_database.php');
require_once('iterator_table.php');
require_once('state_pattern.php');

$header_factory_object = new header_factory;
$body_factory_object = new login_body_factory;
$tail_factory_object = new login_tail_factory;

$database_object = singleton_database::getInstance();
$conn = $database_object->getDatabase();

$email_userID = addslashes($_POST['email_userID']);
$password = addslashes($_POST['password']);

$current_state = new not_logged_in;

$query = <<<SQL
select *
from users
where email = '{$email_userID}' or userID = '{$email_userID}'
SQL;
$header_factory_object->print_page();

if ($result= $conn->query($query))
{
	$row = $result->fetch_assoc();
	if($row){
		if(((strlen($password) == 0) && is_null($row['password'])) || (password_verify($password,$row['password']))) {
			$current_state = new user_logged_in($row);
		}
		else $current_state = new wrong_password;
	}
	else $current_state = new wrong_email;
	$result->free();
} else {
	$current_state = new database_error;
}

$body_factory_object->print_page();


$query2 = <<<SQL
select name,email,appointmentTime,description
from appointments as a,clients as c 
where a.userID = '{$row['userID']}' and 
a.clientID = c.clientID and 
appointmentTime between date_sub(now(),interval 1 hour) and date_add(now(),interval 1 day)
order by appointmentTime
SQL;

print "<p>Today</p>";

if ($result= $conn->query($query2))
{
	$table_builder_object = new profile_table_builder('user',$result);
	$result->free();
}

$query3 = <<<SQL
select name,email,appointmentTime,description
from appointments as a,clients as c 
where a.userID = '{$row['userID']}' and 
a.clientID = c.clientID and 
appointmentTime > now()
order by appointmentTime
SQL;

print "<p>Future</p>";

if ($result= $conn->query($query3))
{
	$table_builder_object = new profile_table_builder('user',$result);
	$result->free();
}

$conn->close();
$tail_factory_object->print_page();
?>
