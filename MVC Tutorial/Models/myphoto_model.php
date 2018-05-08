<?php

class myphoto_Model extends Model {
	function __construct () {
		parent::__construct();
		//echo 'Help model';
	}


	function getPhotoLocation()
	{
		Session::init();
		$array = array();
		$sql = "SELECT Photo FROM photo_user WHERE ID_USER = (SELECT ID FROM users WHERE NAME='".Session::get('loggued_on_user')."')";
		foreach($this->db->query($sql) as $i){
			//echo json_encode($i);
			array_push($array, $i);
		}
		echo json_encode($array);
	}

	function countElement()
	{
		Session::init();
		$sql = "SELECT COUNT(ID) FROM photo_user";
		foreach($this->db->query($sql) as $i){
			echo json_encode($i);
		}
	}

	function countPhotoUser(){
		Session::init();
		$sql = "SELECT COUNT(ID) FROM photo_user WHERE ID_USER = (SELECT ID FROM users where NAME = '".Session::get('loggued_on_user')."')";
		foreach($this->db->query($sql) as $i){
			echo json_encode($i);
		}
	}

	function receivePhoto(){
		Session::init();
		if (isset($_POST['submit']))
		{
			$file = $_FILES['file'];

			$fileName = $_FILES['file']['name'];
			$fileTmpName = $_FILES['file']['tmp_name'];
			$fileSize = $_FILES['file']['size'];
			$fileError = $_FILES['file']['error'];
			$fileType = $_FILES['file']['type'];

			$fileExt = explode('.',$fileName);
			$fileActualExt = strtolower(end($fileExt));

			$allowed = array('jpg', 'jpeg', 'pnd');

			if(in_array($fileActualExt, $allowed))
			{
				if($fileError === 0){
					if($fileSize < 1000000){
						$fileNameNew = uniqid('', true).".".$fileActualExt;
						$fileDestination = 'Public/Images/'.$fileNameNew;
						move_uploaded_file($fileTmpName,$fileDestination);
						$sql = "INSERT INTO photo_user (ID_USER, Photo) VALUES ((SELECT ID FROM users WHERE NAME='".Session::get('loggued_on_user')."'), 'http://localhost/MVC%20Tutorial/Public/Images/".$fileNameNew."')";
						foreach($this->db->query($sql) as $i){
							echo json_encode($i);
						}
						header("Location: ../myphoto");

					} else {
						echo "Your file is to big";
					}
				} else {
					echo "There was an error upoading your file!";
				}
			} else {
				echo "You cannot upload filles of this type!";
			}
		}
		//header("Location: ../myphoto");
	}
	function updateProfilePic() {
		Session::init();
		try {
			$query = $this->db->query("UPDATE data_users SET Profile = '".Session::get('profile')."' WHERE ID_USER=(Select ID from users where NAME='".Session::get('loggued_on_user')."')");
		} catch (PDOException $e)
		{
			die($e->getMessage());
		}
		header('Location: ../success');
	}

	function saveImg(){
		Session::init();
		$name = uniqid('', true).".".'jpg';
		$ifp = fopen( 'Public/Images/'.$name, 'wb' ); 
		fwrite( $ifp, base64_decode( $_POST['nume']) );
		fclose( $ifp ); 
		file_put_contents('Public/Images/', $ifp);

		
		$sql = "INSERT INTO photo_user (ID_USER, Photo) VALUES ((SELECT ID FROM users WHERE NAME='".Session::get('loggued_on_user')."'), 'http://localhost/MVC%20Tutorial/Public/Images/".$name."')";
		foreach($this->db->query($sql) as $i){
			echo json_encode($i);
		}
		header('Location: myphoto');
	}

}