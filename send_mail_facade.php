<?php
/**
 * Does everything related to mail sending using a single class i.e. Facade pattern
 * @author    Md Sakib Anwar 	Roll : 16
 */
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';
require_once('user_client_profile.php');
require_once('singleton_database.php');

class send_mail_facade{
	private $_email;
	private $_user_name;
	private $mail;

	public function __construct($user_name,$email) {
		$this->_user_name = $user_name;
		$this->_email = $email;
		$this->setup_mail();
	}

	public function send_mail($subject,$message){
		$this->mail->addAddress($this->_email,$this->_user_name);
		$this->mail->Subject = $subject;
		$this->mail->Body = $message;
		$this->mail->send();
	}
	
	private function setup_mail(){
		$this->mail = new PHPMailer;
		$this->mail->isSMTP();
		$this->mail->SMTPDebug = 0;
		$this->mail->Host = 'smtp.gmail.com';
		$this->mail->Port = 587;
		$this->mail->SMTPSecure = 'tls';
		$this->mail->SMTPAuth = true;
		$this->mail->Username = "automatedappointmentassistance@gmail.com";
		$this->mail->Password = "nituashraf";
		$this->mail->setFrom('automatedappointmentassistance@gmail.com', 'AAA');
		$this->mail->addReplyTo('automatedappointmentassistance@gmail.com', 'AAA');
	}

	public function change_user_email(){
		$this->_user_name = $user_name;
		$this->_email = $email;
	}
}
?>
