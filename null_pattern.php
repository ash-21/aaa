<?php
require_once('user_client_profile.php');

class singleton_null {
	private $user;
	private $client;
	private $appointment;

	public static function getInstance() {
		static $instance = null;         
		if (null === $instance) {
			$instance = new singleton_null;
		}
		return $instance;
	}
	protected function __construct() {
		$this->user = new null_user;
		$this->client = new null_client;
		$this->appointment = new null_appointment;
	}
	
	private function __clone() {
	}
	
	private function __wakeup() {
	}
	
	public function get_user() {
		return $this->user;
	}

	public function get_client() {
		return $this->client;
	}

	public function get_appointment() {
		return $this->appointment;
	}

}

class null_user extends user{
	public function __construct(){
		$this->name = null;
		$this->profession = null;
		$this->workAddress = null;
		$this->homeAddress = null;
		$this->phone = null;
		$this->email = null;
		$this->password = null;
		$this->password_hash = null;
	}
}

class null_client extends client{
	public function __construct(){
		$this->name = null;
		$this->phone = null;
		$this->email = null;
		$this->password = null;
		$this->password_hash = null;
	}
}

class null_appointment extends appointment{
	public function __construct(){
		$this->appointmentID = null;
		$this->userID = null;
		$this->clientID = null;
		$this->time = null;
		$this->previous_appointment = null;
		$this->next_appointment = null;
	}
}
?>
