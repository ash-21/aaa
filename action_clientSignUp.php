<?php
//Mail requirements
/********************************/
/********************************/
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';

$mail = new PHPMailer;
$mail->isSMTP();
$mail->SMTPDebug = 2;
$mail->Host = 'smtp.gmail.com';
$mail->Port = 587;
$mail->SMTPSecure = 'tls';
$mail->SMTPAuth = true;
$mail->Username = "automatedappointmentassistance@gmail.com";
$mail->Password = "nituashraf";
$mail->setFrom('automatedappointmentassistance@gmail.com', 'AAA');
$mail->addReplyTo('automatedappointmentassistance@gmail.com', 'AAA');
/*******************************/
/********************************/
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = 'asdfzxcv';
$db = 'aaaDatabase';

$conn =new mysqli($dbhost,$dbuser,$dbpass,$db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$userName = addslashes($_POST['userName']);
$email = addslashes($_POST['email']);
$phone = addslashes($_POST['phoneNo']);
$password = $_POST['password'];
$password_hash = password_hash($password, PASSWORD_BCRYPT);

$query = "insert into clients ".
"(name,email,phone,password) ".
"values( '$userName' , '$email' , '$phone' , '$password_hash' )";

$to      = $email;
$subject = 'AAA account is ready';
$message = 'Thank you for joining with us.You can book appointment with any user on our website.';

if ($conn->query($query) === TRUE) {
    echo "<h>New record created successfully</h>"."<br>";
    /********************************/
    /********************************/
    $mail->addAddress($email, $userName);
	$mail->Subject = $subject;
	$mail->Body = $message;
	if (!$mail->send()) {
    	echo "Mailer Error: " . $mail->ErrorInfo;
	} else {
    	echo "Message sent!";
	}
	function save_mail($mail)
	{
    	$path = "{imap.gmail.com:993/imap/ssl}[Gmail]/Sent Mail";
    	$imapStream = imap_open($path, $mail->Username, $mail->Password);
		$result = imap_append($imapStream, $path, $mail->getSentMIMEMessage());
    	imap_close($imapStream);
    	return $result;
	}
	/********************************/
	/********************************/
} else {
    echo "Error: " . $query . "<br>" . $conn->error;
}

print "<script>
		window.location='index.html';
		</script>";

$conn->close();

?>
