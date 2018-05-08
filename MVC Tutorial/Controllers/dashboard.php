<?php

class Dashboard extends Controller
{
	
	function __construct(){
		parent::__construct();
		Session::init();
		$logged = Session::get('loggedIN');
		//var_dump($logged);
		if ($logged == false)
		{
			Session::destroy();
			header('location: login');
			exit;
		}
		//$this->view->js = array('dashboard/js/default.js');
	}
	function index(){
		$this->view->render('dashboard/index');
	}

	function logout(){
		Session::destroy();
		header('location: ../index');
	}

	function  getValidation()
	{
		$this->model->getValidation();
	}
	function  setValidation()
	{
		$this->model->setValidation();
	}
	function  getProfileLocation()
	{
		$this->model->getProfileLocation();
	}
	function  getCountAllPhoto()
	{
		$this->model->getCountAllPhoto();
	}
	function  getAllPhotoLocation()
	{
		$this->model->getAllPhotoLocation();
	}
	function setComments()
	{
		$this->model->setComments();
	}
	function getComments()
	{
		$this->model->getComments();
	}

	function getCountComments()
	{
		$this->model->getCountComments();
	}
}