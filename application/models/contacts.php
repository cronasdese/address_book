<?php

class Contacts extends CI_Model{
	function __construct(){
		parent::__construct(); // Call the model constructor
	}

	function getContacts(){
		$query = $this->db->query('SELECT * FROM contacts ORDER BY last_name');
		if($query->num_rows() > 0){
			return $query->result();
		}
		else{
			return NULL;
		}
	}

}