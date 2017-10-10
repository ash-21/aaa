<html>
<body>

<?php
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = 'asdfzxcv';
$db = 'aaaDatabase';


$conn =new mysqli($dbhost,$dbuser,$dbpass,$db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = addslashes($_POST['email']);
$password = addslashes($_POST['password']);

$query = <<<SQL
	select password
	from users
	where email = '{$email}'
SQL;

if ($result= $conn->query($query))
{
  $row = $result->fetch_assoc();
  if($row){
  	if(password_verify($password,$row['password'])) printf("Success");
  	else printf("Failure :(");
  }
  else printf("No such mail id");
  $result->free();
} else {
    echo "Error: " . $query . "<br>" . $conn->error;
}

$conn->close();

?>

</body>
</html>

