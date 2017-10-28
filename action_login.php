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
from users
where email = '{$email_userID}' or userID = '{$email_userID}'
SQL;
$query2 = <<<SQL
select *
from appointments
where userID = '{$flag}'
SQL;
$query3 = <<<SQL
select *
from clients
where clientID = '{$flag2}'
SQL;

$flag = '';

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


if ($result2= $conn->query($query2))
{
	while ($row2 = $result2->fetch_assoc()) {
		$flag2 = $row2['clientID'];
		
		$result3= $conn->query($query3);
		$row3 = $result3->fetch_assoc();
		print "<tr>
		<td><i class=\"w3-text-blue w3-large\"></i></td>
		<td><i>{$row3['name']}</i></td>
		<td><i>{$row2['appointmentTime']}</i></td>
		<td><i>{$row2['appointmentID']}</i></td>
		</tr>";
		}
		$result2->free();
		}

		$conn->close();
		$tail_factory_object->print_page();
		?>
