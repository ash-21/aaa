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

$userName = addslashes($_POST['userName']);
$profession = addslashes($_POST['profession']);
$homeAddress = addslashes($_POST['homeAddress']);
$workAddress = addslashes($_POST['workAddress']);
$email = addslashes($_POST['email']);
$phone = addslashes($_POST['phoneNo']);
$password = $_POST['password'];
$password_hash = password_hash($password, PASSWORD_BCRYPT);

$query = "insert into users ".
"(name,profession,homeAddress,workAddress,email,phone,password_hash) ".
"values( '$userName' , '$profession' , '$homeAddress' , '$workAddress' , '$email' , '$phone' , '$password_hash' )";

$subject = 'AAA account is ready';
$message = 'Thank you for joining with us. You can now login https://rawgit.com/ash-21/aaa/master/login.html ';

if ($conn->query($query) === TRUE) {
    echo "New record created successfully";
    mail($email, $subject, $message);
} else {
    echo "Error: " . $query . "<br>" . $conn->error;
}

$conn->close();

?>

</body>
</html>

