<?php
class myphoto extends Controller
{
	
	function __construct(){
		parent::__construct();
	}
	function index(){
		$this->view->render('myphoto/index');
	}
	function  countElement()
	{
		$this->model->countElement();
	}
	function  getPhotoLocation()
	{
		$this->model->getPhotoLocation();
	}
	function countPhotoUser()
	{
		$this->model->countPhotoUser();
	}
	function receivePhoto()
	{
		$this->model->receivePhoto();
	}

	function saveImg()
	{
		$this->model->saveImg();
	}

}
