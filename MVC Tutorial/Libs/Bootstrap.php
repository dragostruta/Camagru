<?php

class Bootstrap
{
	function __construct(){

		$url = isset($_GET['url']) ? $_GET['url'] : null;
		$url = rtrim($url, '/');
		$url = explode('/', $url);
		//print_r($url);

		if (empty($url[0])){
			require 'Controllers/index.php';
			$controller = new index();
			$controller->index();
			return false;
		}
		$file = 'Controllers/'.$url[0].'.php';
		if (file_exists($file)){
			require $file;
		} else {
			$this->error();
		}
		if (class_exists($url[0]))
		{
			try{
				$controller = new $url[0];
				$controller->loadModel($url[0]);
			
			} catch (PDOException $e)
			{
				die($e->getMessage());
			}
		}
		else
		{
			$controller = new Errors();
			exit;
		}
		
		/*
		if (class_exists($url[0]))
			$controller = new $url[0];
		else
		{
			$this->error();
		}
		*/
		//calling methods

		if (isset($url[2])) {
			if (method_exists($controller, $url[1])) {
				$controller->{$url[1]}($url[2]);
			} else {
				$this->error();
			}
		} else {
			if (isset($url[1])) {
				if (method_exists($controller, $url[1])) {
					$controller->{$url[1]}();
				} else {
					$this->error();
				}
			} else {
				$controller->index();
			}
		}
	}
	function error() {
		require 'Controllers/errors.php';
		$controller = new Errors();
		$controller->index();
		return false;
	}
}