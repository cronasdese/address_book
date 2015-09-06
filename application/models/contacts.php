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

	function searchContact($search){
		$query = $this->db->query('SELECT * FROM contacts WHERE (first_name LIKE "%'.$search.'%") OR (last_name LIKE "%'.$search.'%") OR (contact_number LIKE "%'.$search.'%") OR (email_address LIKE "%'.$search.'%") OR (email_address LIKE "%'.$search.'%") ORDER BY last_name');
		if($query->num_rows() > 0){
			return $query->result();
		}
		else{
			return NULL;
		}
	}

	function addContacts($first_name, $last_name, $contact_number, $address, $email_address, $image){

		$new_contact_data = array(
			'first_name' => $first_name,
			'last_name' => $last_name,
			'contact_number' => $contact_number,
			'address' => $address,
			'email_address' => $email_address,
			'picture' => $image,
		);

		$this->db->insert('contacts', $new_contact_data);
	}

	function deleteContact($id){
		$delete = $this->db->delete('contacts', array('id' => $id));
	}

	function updateContact($id){
		$updated_contact_data = array(
			'first_name' => $this->input->post('inputFirstName'),
			'last_name' => $this->input->post('inputLastName'),
			'contact_number' => $this->input->post('inputContactNumber'),
			'address' => $this->input->post('inputAddress'),
			'email_address' => $this->input->post('inputEmailAddress'),
			'picture' => $this->input->post('insertPicture'),
		);

		$this->db->where('id', $id);
		$this->db->update('contact', $updated_contact_data);
	}
}