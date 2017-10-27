<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';

function __autoload($class_name) {
  require_once $class_name . '.php';
}

class strategy_signup{
	private $strategyObject = null;
	private $_email;
	private $_password;
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
    
    public function signUp($email,$password){
		$this->$strategyObject->signUp($email_id,$password);
		$this->$_email = $email;
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
	public function signUp($email_id,$password);
}

class client_signup implements strategy{
	public function signUp($email_id,$password){
		echo 'client: yeay';
	}
}

class user_signup implements strategy{
	public function signUp($email_id,$password){
		echo 'user: yeay';
	}
}


?>
