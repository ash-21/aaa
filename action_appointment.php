<?php

require_once('singleton_database.php');

$database_object = singleton_database::getInstance();
$conn = $database_object->getDatabase();

$clientID = addslashes($_POST['clientID']);
$userID = addslashes($_POST['userID']);
$description = $_POST['description'];

$query = <<<SQL
	INSERT INTO appointments (userID,clientID,description) VALUES('{$userID}','{$clientID}','{$description}');
SQL;

if ($conn->query($query) === TRUE)
{
$query2 = <<<SQL
	select *
	from clients
	where clientID = '{$clientID}'
SQL;
if ($result= $conn->query($query2))
{
	$row = $result->fetch_assoc();
	$password = $row['password'];
}

print"<html>
	<body>
	<form id=\"form1\" action=\"action_login_client.php\" method=\"POST\">
	<input type=\"hidden\" id=\"email_userID\" value=\"$clientID\" />
	</form>

	<script>
	document.getElementById(\"form1\").submit();
	</script>
	
	</body>
	</html>";

$conn->close();
}
?>

