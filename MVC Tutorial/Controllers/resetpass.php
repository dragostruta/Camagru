<?php
class resetpass extends Controller
{
	
	function __construct(){
		parent::__construct();
	}
	function index(){
		$this->view->render('resetpass/index');
	}
	function run(){
		$this->model->resetpass_funct();
	}
}