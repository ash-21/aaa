<?php
class user{
	var $name;
	var $profession;
	var $workAddress;
	var $homeAddress;
	var $phone;
	var $email;
	var $password;
	var $password_hash;
	
	public function __construct($user_name,$profession,$workAddress,$homeAddress,$email,$phone,$password){
		$this->name = $user_name;
		$this->profession = $profession;
		$this->workAddress = $workAddress;
		$this->homeAddress = $homeAddress;
		$this->phone = $phone;
		$this->email = $email;
		$this->password = $password;
		$this->password_hash = password_hash($password, PASSWORD_BCRYPT);
	}
}

class client{
	public $name;
	public $phone;
	public $email;
	public $password;
	
	public function __construct($client_name,$email,$phone,$password){
		$this->name = $client_name;
		$this->phone = $phone;
		$this->email = $email;
		$this->password = $password;
		$this->password_hash = password_hash($password, PASSWORD_BCRYPT);
	}
}

class appointment{
	public $appointmentID;
	public $userID;
	public $clientID;
	public $time;
	public $previous_appointment;
	public $next_appointment;

	public function __construct($appointmentID,$userID,$clientID,$time){
		$this->appointmentID = $appointmentID;
		$this->userID = $userID;
		$this->clientID = $clientID;
		$this->time = $time;
	}

	public function add_previous_appointment($prev_app){
		$this->previous_appointment = $perv_app;
		return $this;
	}

	public function add_next_appointment($next_app){
		$this->next_appointment = $perv_app;
		return $this;
	}
}
?>
