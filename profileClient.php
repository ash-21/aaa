<?php
require_once('factory_page.php');
require_once('singleton_database.php');
require_once('iterator_table.php');


$database_object = singleton_database::getInstance();
$header_factory_object = new header_factory;
$body_factory_object = new login_body_factory;
$tail_factory_object = new login_tail_factory;

$conn = $database_object->getDatabase();

$userID = $_POST['id'];
$clientID = $_SESSION['userID'];

$query = <<<SQL
select *
from users
where userID = '{$userID}'
SQL;

$header_factory_object->print_page();

if ($result= $conn->query($query))
{
	$row = $result->fetch_assoc();
	if($row){
		print "<h2><strong>{$row['name']}</strong></h2>";
		print "<p><i class=\"fa fa-address-card fa-fw w3-margin-right w3-large w3-text-teal\"></i>{$row['userID']}</p>";
		print "<p><i class=\"fa fa-briefcase fa-fw w3-margin-right w3-large w3-text-teal\"></i>{$row['profession']}</p>";
		print "<p><i class=\"fa fa-home fa-fw w3-margin-right w3-large w3-text-teal\"></i>{$row['workAddress']}</p>";
		print "<p><i class=\"fa fa-envelope fa-fw w3-margin-right w3-large w3-text-teal\"></i>{$row['email']}</p>";
		print "<p><i class=\"fa fa-phone fa-fw w3-margin-right w3-large w3-text-teal\"></i>{$row['phone']}</p>";
	}
	else print "<h1>No Such Profile <i class=\"fa fa-meh-o\"></i></h1> ";
}
else {
	echo "Error: " . $query . "<br>" . $conn->error;
}

$body_factory_object->print_page();

print "<form action=\"/form-action\" method=\"POST\">
	<h3>Description</h3>
	<input class=\"w3-input w3-border\" type=\"text\" style=\"height:100px\" size=\"1024\">
	<h3>Appointment Time</h3>
	<input id=\"date\" type=\"date\">
	<input type=\"submit\" value=\"Appointment Now!\"> ";
	 
?>