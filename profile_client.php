<?php
session_start();

require_once('page_decorator.php');
require_once('singleton_database.php');
require_once('iterator_table.php');

$header_decorator_object = new header_decorator;
$body_decorator_object = new login_body_decorator;

$database_object = singleton_database::getInstance();
$conn = $database_object->getDatabase();

$userID = $_POST['id'];
$clientID = $_SESSION['clientID'];

$query = <<<SQL
select *
from users
where userID = '{$userID}'
SQL;

$page = null;
$page = $header_decorator_object->decorate_page($page);

if ($result= $conn->query($query))
{
	$row = $result->fetch_assoc();
	if($row){
		$page .= "<h2><strong>{$row['name']}</strong></h2>
		<p><i class=\"fa fa-address-card fa-fw w3-margin-right w3-large w3-text-teal\"></i>{$row['userID']}</p>
		<p><i class=\"fa fa-briefcase fa-fw w3-margin-right w3-large w3-text-teal\"></i>{$row['profession']}</p>
		<p><i class=\"fa fa-home fa-fw w3-margin-right w3-large w3-text-teal\"></i>{$row['workAddress']}</p>
		<p><i class=\"fa fa-envelope fa-fw w3-margin-right w3-large w3-text-teal\"></i>{$row['email']}</p>
		<p><i class=\"fa fa-phone fa-fw w3-margin-right w3-large w3-text-teal\"></i>{$row['phone']}</p>";
	}
	else $page .= "<h1>No Such Profile <i class=\"fa fa-meh-o\"></i></h1> ";
}
else {
	echo "Error: " . $query . "<br>" . $conn->error;
}

$page = $body_decorator_object->decorate_page($page);

$page .= "<form action=\"/action_appointment.php\" method=\"POST\">
<h3>Description</h3>
<input class=\"w3-input w3-border\" type=\"text\" name=\"description\" style=\"height:100px\" size=\"1024\">
<input type=\"hidden\" name=\"userID\" value=\"{$userID}\">
<input type=\"hidden\" name=\"clientID\" value=\"{$clientID}\">
<input type=\"submit\" value=\"Appointment Now!\"> 
</form>";

echo "{$page}";
?>
