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
?>
