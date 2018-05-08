<?php

class Controller {
	function __construct (){
		//echo 'Main controller';
		$this->view = new View();
	}

	public function loadModel($name){

		$path = 'Models/'.$name.'_model.php';

		if (file_exists($path)){
			require 'Models/'.$name.'_model.php';
			$modelName = $name . '_Model';
			$this->model = new $modelName;
		}
	}
}