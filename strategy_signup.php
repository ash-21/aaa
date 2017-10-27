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
	private $strategyObject = null;
	private $_email;
	private $mail;
	private $subject = 'AAA account is ready';
	private $message = 'Thank you for joining with us.You can book appointment with any user on our website.';
	
	public function __construct($strategy_ind_id) {
        if($strategy_ind_id==='client') {
        	$this->$strategyObject = new client_signup;
        }
        else $this->$strategyObject = new user_signup;
        
        $this->setup_mail();
    }
    
    public function signUp($user_client_object){
		if($this->$strategyObject->signUp($user_client_object)===TRUE){
			$this->_email = $user_client_object->$email;
			$this->send_mail();
			return TRUE;
		}
		else return FALSE;
	}
	
	public function send_mail(){
		
	}
	
	private function setup_mail(){
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
	}
}

interface strategy{
	public function signUp($object);
}

class client_signup implements strategy{
	public function signUp($clientObject){
		$database_object = singleton_database::getInstance();

		$conn = $database_object->getDatabase();
		
		$query = "insert into clients ".
				"(name,email,phone,password) ".
				"values( '{$clientObject->client_name}' , '{$clientObject->email}' , '{$clientObject->phone}' , '{$clientObject->password_hash}' )";
		
		if ($conn->query($query) === TRUE) return TRUE;
		return FALSE;
	}
}

class user_signup implements strategy{
	public function signUp($userObject){
		$database_object = singleton_database::getInstance();
		
		$conn = $database_object->getDatabase();
		
		$query = "insert into users ".
				 "(name,profession,homeAddress,workAddress,email,phone,password) ".
				 "values( '{$userObject->user_name}' , '{$userObject->profession}' , '{$userObject->homeAddress}' , '{$userObject->workAddress}' , '{$userObject->email}' , '{$userObject->phone}' , '{$userObject->password_hash}' )";
		
		if ($conn->query($query) === TRUE) return TRUE;
		else return FALSE;
	}
}


?>
