<?php
/**
 * Uses command pattern to carry out sign up using strategy pattern
 * @author    Md Sakib Anwar 	Roll : 16
 */
require_once('user_client_profile.php');
require_once('singleton_database.php');
require_once('send_mail_facade.php');

class strategy_signup{
	private $strategy_object = null;
	private $user_client_object;
	private $mail_sender;
	private $subject = 'AAA account is ready';
	private $message = 'Thank you for joining with us.You can book appointment with any user on our website.';

	public function __construct($user_client_object) {
		$this->user_client_object = $user_client_object;
		if(get_class($this->user_client_object)==='client') {
			$this->strategy_object = new client_signup;
		}
		else $this->strategy_object = new user_signup;
		$this->mail_sender = new send_mail_facade($this->user_client_object->name,$this->user_client_object->email);
	}
	
	public function signUp(){
		if($this->strategy_object->signUp($this->user_client_object)===TRUE){
			$this->mail_sender->send_mail($this->subject,$this->message);
			return TRUE;
		}
		else return FALSE;
	}
}

abstract class strategy{
	protected $database_object;
	protected $conn;
	public function __construct(){
		$this->database_object = singleton_database::getInstance();
		$this->conn = $this->database_object->getDatabase();
	}
	public abstract function signUp($object);
}

class client_signup extends strategy{
	public function signUp($client_object){
		$query = "insert into clients ".
		"(name,email,phone,password) ".
		"values( '{$client_object->name}' , '{$client_object->email}' , '{$client_object->phone}' , '{$client_object->password_hash}' )";
		
		if ($this->conn->query($query) === TRUE) return TRUE;
		return FALSE;
	}
}

class user_signup extends strategy{
	public function signUp($user_object){
		$query = "insert into users ".
		"(name,profession,homeAddress,workAddress,email,phone,password) ".
		"values( '{$user_object->name}' , '{$user_object->profession}' , '{$user_object->homeAddress}' , '{$user_object->workAddress}' , '{$user_object->email}' , '{$user_object->phone}' , '{$user_object->password_hash}' )";
		
		if ($this->conn->query($query) === TRUE) return TRUE;
		else return FALSE;
	}
}


?>
