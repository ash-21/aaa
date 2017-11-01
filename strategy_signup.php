<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';
require_once('user_client_profile.php');
require_once('singleton_database.php');

class strategy_signup{
	private $strategy_object = null;
	private $user_client_object;
	private $_email;
	private $_user_name;
	private $mail;
	private $subject = 'AAA account is ready';
	private $message = 'Thank you for joining with us.You can book appointment with any user on our website.';
	
	public function __construct($user_client_object) {
		$this->user_client_object = $user_client_object;
		if(get_class($this->user_client_object)==='client') {
			$this->strategy_object = new client_signup;
		}
		else $this->strategy_object = new user_signup;
		
		$this->setup_mail();
	}
	
	public function signUp(){
		if($this->strategy_object->signUp($this->user_client_object)===TRUE){
			$this->_email = $this->user_client_object->email;
			$this->_user_name = $this->user_client_object->name;
			$this->send_mail();
			return TRUE;
		}
		else return FALSE;
	}
	
	public function send_mail(){
		$this->mail->addAddress($this->_email,$this->_user_name);
		$this->mail->Subject = $this->subject;
		$this->mail->Body = $this->message;
		$this->mail->send();
	}
	
	private function setup_mail(){
		$this->mail = new PHPMailer;
		$this->mail->isSMTP();
		$this->mail->SMTPDebug = 2;
		$this->mail->Host = 'smtp.gmail.com';
		$this->mail->Port = 587;
		$this->mail->SMTPSecure = 'tls';
		$this->mail->SMTPAuth = true;
		$this->mail->Username = "automatedappointmentassistance@gmail.com";
		$this->mail->Password = "nituashraf";
		$this->mail->setFrom('automatedappointmentassistance@gmail.com', 'AAA');
		$this->mail->addReplyTo('automatedappointmentassistance@gmail.com', 'AAA');
	}
}

interface strategy{
	public function signUp($object);
}

class client_signup implements strategy{
	public function signUp($client_object){
		$database_object = singleton_database::getInstance();

		$conn = $database_object->getDatabase();
		
		$query = "insert into clients ".
		"(name,email,phone,password) ".
		"values( '{$client_object->name}' , '{$client_object->email}' , '{$client_object->phone}' , '{$client_object->password_hash}' )";
		
		if ($conn->query($query) === TRUE) return TRUE;
		return FALSE;
	}
}

class user_signup implements strategy{
	public function signUp($user_object){
		$database_object = singleton_database::getInstance();
		
		$conn = $database_object->getDatabase();
		
		$query = "insert into users ".
		"(name,profession,homeAddress,workAddress,email,phone,password) ".
		"values( '{$user_object->name}' , '{$user_object->profession}' , '{$user_object->homeAddress}' , '{$user_object->workAddress}' , '{$user_object->email}' , '{$user_object->phone}' , '{$user_object->password_hash}' )";
		
		if ($conn->query($query) === TRUE) return TRUE;
		else return FALSE;
	}
}


?>
