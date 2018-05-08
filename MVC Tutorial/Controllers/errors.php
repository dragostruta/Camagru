<?php
class Errors extends Controller{
	function __construct() {
		parent::__construct();
	}
	function index(){
		//echo 'This is an error';
		$this->view->render('errors/index');
	}
}