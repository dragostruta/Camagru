<?php
class signup extends Controller
{
	
	function __construct(){
		parent::__construct();
	}
	function index(){
		$this->view->render('signup/index');
	}
	function run(){
		$this->model->signup_funct();
	}
}