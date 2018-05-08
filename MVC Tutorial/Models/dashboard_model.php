<?php

class Dashboard_Model extends Model {
	function __construct () {
		parent::__construct();
		//echo 'Help model';
	}

	function xhrInsert()
	{
		//$text = $_POST['text'];

		//$sth = $this->db->prepare('INSERT INTO');
		//$sth->db->execute();
	}

	function xhrGetListed()
	{
		//$sth = $this->db->prepare('Select * FROM');
		//$sth->setFetchMode(PDO::FETCH_ASSOC);
		//$sth->execute();
		//$data = $sth->fetchAll();
		//echo json_encode($data);
	}

	function xhrDeleteListed()
	{
		//$id = $_POST['id'];
		//$sth = $this->db->prepare('DELETE FROM data WHERE id = "'.$id.'"');
		//$sth->execute();
	}

	function  getValidation()
	{
		Session::init();
		try {
		$sql = "SELECT VALIDATION FROM users WHERE NAME='".Session::get('loggued_on_user')."'";
		foreach($this->db->query($sql) as $i)
			echo json_encode($i);
		} catch (PDOException $e)
		{
			die($e->getMessage());
		}
	}

	function setValidation()
	{
		Session::init();
		try {
			$query = $this->db->query("UPDATE users SET VALIDATION = 'TRUE' WHERE NAME='".Session::get('loggued_on_user')."'");
		} catch (PDOException $e)
		{
			die($e->getMessage());
		}
		header('Location: ../success');
	}

	function getProfileLocation()
	{
		Session::init();
		$sql = "SELECT Profile FROM Data_user WHERE ID_USER = (SELECT ID FROM users WHERE NAME='".Session::get('loggued_on_user')."')";
		foreach($this->db->query($sql) as $i){
			echo json_encode($i);
		}
	}

	function getCountAllPhoto()
	{
		Session::init();
		$sql = "SELECT COUNT(ID) FROM photo_user";
		foreach($this->db->query($sql) as $i){
			echo json_encode($i);
		}
	}

	function getAllPhotoLocation()
	{
		Session::init();
		$array = array();
		$sql = "SELECT photo_user.ID ,users.NAME, photo_user.Photo
		FROM users
		INNER JOIN photo_user ON users.ID = photo_user.ID_USER
		ORDER BY photo_user.ID ASC;";
		foreach($this->db->query($sql) as $i){
			//echo json_encode($i);
			array_push($array, $i);
		}
		echo json_encode($array);
	}

	function setComments(){
		Session::init();
		$text = $_POST['myInput'];
		$id_post = $_POST['submit'];
		//var_dump($_POST);
		$sql = "INSERT INTO comments (value, ID_post, ID_user) VALUES ('$text','$id_post', (SELECT ID FROM users WHERE NAME='".Session::get('loggued_on_user')."'))";
		$query = $this->db->query($sql);
		header("Location: ../dashboard");
	}

	function getComments(){
		Session::init();
		$sql = "SELECT value,NAME,ID_post
		FROM comments
		INNER JOIN users ON comments.ID_user = users.ID
		ORDER BY comments.ID ASC;";
		$array = array();
		foreach($this->db->query($sql) as $i){
			array_push($array ,$i);
		}
		echo json_encode($array);
	}

	function getCountComments()
	{
		Session::init();
		$sql = "SELECT COUNT(ID) FROM comments";
		foreach($this->db->query($sql) as $i){
			echo json_encode($i);
		}
	}
}