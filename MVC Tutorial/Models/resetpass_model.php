<?php

class ResetPass_Model extends Model {
	public $errors = array();
	public $data = array();
	private $validation = true;

	public function __construct(){
		parent::__construct();
	}

	public function resetPass_funct(){
		try {
					$query = $this->db->query("SELECT * FROM users WHERE NAME='".$_POST['Login']."' AND EMAIL='".$_POST['email']."'");
					} catch (PDOException $e)
					{
						die($e->getMessage());
					}
					$new = $_POST['new'];
					$email = $_POST['email'];
					$count = $query->rowCount();
					if ($count != 1){
						$this->validation = false;
						//array_push($this->errors, $email);
						array_push($this->errors,"This account does not exist");
					}
					if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
						$this->validation = false;
						array_push($this->errors,"Wrong email validation");
					}
					$v1 = true;
					$v2 = true;
					$v3 = true;
					if (strlen($new) < 8) {
						$v1 = false;
				        array_push($this->errors,"Password too short!");
				    }

				    if (!preg_match("#[0-9]+#", $new)) {
				    	$v2 = false;
				        array_push($this->errors,"Password must include at least one number!");
				    }

				    if (!preg_match("#[a-zA-Z]+#", $new)) {
				    	$v3 = false;
				        array_push($this->errors,"Password must include at least one letter!");
				    } 

				    if ($v1 == false || $v2 == false || $v3 == false)
				    {
				    	$this->validation = false;
				    }
				    if ($this->validation) {
					try {
					$var2 = $new;
					$var2 = md5($var2);
					$this->db->query("UPDATE users SET PASSWORD = '".$var2."' WHERE NAME='".$_POST['Login']."'");	
					} catch (PDOException $e)
					{	
						die($e->getMessage()); 
					}
					header("Location: ../success");
			} else {
				Session::init();
				 //array_push($this->errors,"BAA");
				Session::set('errors', $this->errors);
				//$_SESSION["data"] = $this->data;
				header("Location: ../resetpass");
			}
			}
	}