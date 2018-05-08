<?php

class Model {
	function __construct() {
		$this->db = new Database();
		$this->db->query("CREATE DATABASE IF NOT EXISTS Camagru");
		$this->db->query("use Camagru");
		$this->db->query("
			CREATE TABLE IF NOT EXISTS users (
			ID INT(11) PRIMARY KEY AUTO_INCREMENT,
			NAME VARCHAR(255) NOT NULL,
			PASSWORD VARCHAR(129) NOT NULL,
			EMAIL VARCHAR(255) NOT NULL,
			VALIDATION VARCHAR(255) NOT NULL
		);");

		$this->db->query("
			CREATE TABLE IF NOT EXISTS Data_user (
			ID INT(11) PRIMARY KEY AUTO_INCREMENT,
			ID_USER INT(11) references users(ID),
			Profile VARCHAR(255) NOT NULL
		);");

		$this->db->query("
			CREATE TABLE IF NOT EXISTS Photo_user (
			ID INT(11) PRIMARY KEY AUTO_INCREMENT,
			ID_USER INT(11) references users(ID),
			Photo VARCHAR(255) NOT NULL,
			Likes INT(11)
		);");

		$this->db->query("
			CREATE TABLE IF NOT EXISTS comments (
			ID INT(11) PRIMARY KEY AUTO_INCREMENT,
			ID_post INT(11) references Photo_user(ID),
			value VARCHAR(255),
			ID_user INT(11) references user(ID)
		);");
	}
	public function query($sql) {
		$query = $this->db->prepare($sql);
		$query->execute();

		return $query;
	}
	/*
	public function create(){
		$this->db->query("
			CREATE TABLE IF NOT EXISTS users (
			ID INT(11) PRIMARY KEY AUTO_INCREMENT,
			NAME VARCHAR(255) NOT NULL,
			PASSWORD VARCHAR(129) NOT NULL,
			EMAIL VARCHAR(255) NOT NULL,
			VALIDATION VARCHAR(255) NOT NULL
		);");

		$this->db->query("
			CREATE TABLE IF NOT EXISTS Data_user (
			ID INT(11) PRIMARY KEY AUTO_INCREMENT,
			ID_USER INT(11) references users(ID),
			Profile VARCHAR(255) NOT NULL
		);");
	}*/
}