<?php
class user{
	var $user_name;
	var $profession;
	var $workAddress;
	var $homeAddress;
	var $phone;
	var $email;
	var $password;
	var $password_hash;
	
	public function __construct($user_name,$profession,$workAddress,$homeAddress,$email,$phone,$password){
		$this->user_name = $user_name;
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
	public $client_name;
	public $phone;
	public $email;
	public $password;
	
	public function __construct($client_name,$email,$phone,$password){
		$this->client_name = $client_name;
		$this->phone = $phone;
		$this->email = $email;
		$this->password = $password;
		$this->password_hash = password_hash($password, PASSWORD_BCRYPT);
		
		echo "<br>{$client_name},{$email},{$phone},{$password}<br>";
	}
}
?>
