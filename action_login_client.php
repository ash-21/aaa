<?php
require_once('factory_page.php');
require_once('singleton_database.php');


$database_object = singleton_database::getInstance();
$header_factory_object = new header_factory;
$body_factory_object = new login_body_factory;
$tail_factory_object = new login_tail_factory;

$conn = $database_object->getDatabase();

$email_userID = addslashes($_POST['email_userID']);
$password = addslashes($_POST['password']);

$query = <<<SQL
select *
from clients
where email = '{$email_userID}' or clientID = '{$email_userID}'
SQL;
$header_factory_object->print_page();

if ($result= $conn->query($query))
{
	$row = $result->fetch_assoc();
	if($row){
		if(((strlen($password) == 0) && is_null($row['password'])) || (password_verify($password,$row['password']))) {
			print "<h2><strong>{$row['name']}</strong></h2>";
			print "<p><i class=\"fa fa-address-card fa-fw w3-margin-right w3-large w3-text-teal\"></i>{$row['clientID']}</p>";
			print "<p><i class=\"fa fa-envelope fa-fw w3-margin-right w3-large w3-text-teal\"></i>{$row['email']}</p>";
			print "<p><i class=\"fa fa-phone fa-fw w3-margin-right w3-large w3-text-teal\"></i>{$row['phone']}</p>";
			$flag = $row['userID'];
		}
		else print "<h1>No Such Profile <i class=\"fa fa-meh-o\"></i></h1> ";
	}
	else printf("No such mail id");
	$result->free();
} else {
	echo "Error: " . $query . "<br>" . $conn->error;
}

$body_factory_object->print_page();

$query2 = <<<SQL
select name,email,appointmentTime
from appointments as a,users as u 
where a.clientID = '{$row['clientID']}' and 
a.userID = u.userID and 
appointmentTime between date_sub(now(),interval 1 hour) and date_add(now(),interval 1 day)
SQL;

if ($result2= $conn->query($query2))
{
	while ($row2 = $result2->fetch_assoc()) {
		print "<tr>
		<td><i class=\"w3-text-blue w3-large\"></i></td>
		<td><i>{$row2['name']}</i></td>
		<td><i>{$row2['email']}</i></td>
		<td><i>{$row2['appointmentTime']}</i></td>
		</tr></tbody>";
	}
	$result2->free();
}

$query3 = <<<SQL
select name,email,appointmentTime
from appointments as a,users as u 
where a.clientID = '{$row['clientID']}' and 
a.userID = u.userID and 
appointmentTime > now()
SQL;
if ($result2= $conn->query($query3))
{
	while ($row2 = $result2->fetch_assoc()) {
		print "<tbody>
		<tr>
		<td><i class=\"w3-text-blue w3-large\"></i></td>
		<td><i>{$row2['name']}</i></td>
		<td><i>{$row2['email']}</i></td>
		<td><i>{$row2['appointmentTime']}</i></td>
		</tr>";
	}
	$result2->free();
}

$conn->close();
$tail_factory_object->print_page();
?>
