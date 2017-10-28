<?php
require_once('factory_page.php');
require_once('singleton_database.php');
require_once('iterator_table.php');


$database_object = singleton_database::getInstance();
$header_factory_object = new header_factory;
$body_factory_object = new login_body_factory;
$tail_factory_object = new login_tail_factory;

$conn = $database_object->getDatabase();

$email_userID = addslashes($_POST['email_userID']);
$password = addslashes($_POST['password']);

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
			print "<h2><strong>{$row['name']}</strong></h2>";
			print "<p><i class=\"fa fa-address-card fa-fw w3-margin-right w3-large w3-text-teal\"></i>{$row['userID']}</p>";
			print "<p><i class=\"fa fa-briefcase fa-fw w3-margin-right w3-large w3-text-teal\"></i>{$row['profession']}</p>";
			print "<p><i class=\"fa fa-home fa-fw w3-margin-right w3-large w3-text-teal\"></i>{$row['workAddress']}</p>";
			print "<p><i class=\"fa fa-envelope fa-fw w3-margin-right w3-large w3-text-teal\"></i>{$row['email']}</p>";
			print "<p><i class=\"fa fa-phone fa-fw w3-margin-right w3-large w3-text-teal\"></i>{$row['phone']}</p>";
		}
		else print "<h1>No Such Profile <i class=\"fa fa-meh-o\"></i></h1> ";
	}
	elsez printf("No such mail id");
	$result->free();
} else {
	echo "Error: " . $query . "<br>" . $conn->error;
}

$body_factory_object->print_page();


$query2 = <<<SQL
select name,email,appointmentTime
from appointments as a,clients as c 
where a.userID = '{$row['userID']}' and 
a.clientID = c.clientID and 
appointmentTime between date_sub(now(),interval 1 hour) and date_add(now(),interval 1 day)
SQL;

print "<p>Today</p>";

if ($result= $conn->query($query2))
{
	$table_builder_object = new profile_table_builder('user',$result);
	$result->free();
}

$query3 = <<<SQL
select name,email,appointmentTime
from appointments as a,clients as c 
where a.userID = '{$row['userID']}' and 
a.clientID = c.clientID and 
appointmentTime > now()
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
