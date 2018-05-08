<?php

class Login_Model extends Model {
	public function __construct(){
		parent::__construct();
	}
	public function run(){

		try {
				$query = $this->db->query("SELECT * FROM users WHERE NAME='".$_POST['Login']."' AND PASSWORD='".md5($_POST['Pass'])."'");
			} catch (PDOException $e)
			{
				die($e->getMessage());
			}
		$count = $query->rowCount();
		if ($count > 0)
		{
			Session::init();
			Session::set('loggued_on_user', $_POST['Login']);
			Session::set('loggedIN', true);
			header('location: ../dashboard');
		} else {
			Session::init();
			Session::set('loggued_on_user', "");
			Session::set('errors', "Login Failed!");
			Session::set('loggedIN', false);
			header('location: ../login');
		}
		//print_r($data);

	}
}