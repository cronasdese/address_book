<?php
class Contacts_ extends CI_Controller {

	function __construct(){
		parent::__construct(); // Call the model constructor
	}

	public function index(){
		$this->home();
	}

	public function home(){
		$this->load->model('contacts');
		$data['title'] = 'Address Book';
		$data['contacts_info'] = $this->contacts->getContacts();
		$this->load->view('home', $data);
	}

	public function addcontact(){
		$this->load->helper('url');
		$this->load->model('contacts');

		$first_name = $_GET['inputFirstName'];
		$last_name = $_GET['inputLastName'];
		$contact_number = $_GET['inputContactNumber'];
		$address = $_GET['inputAddress'];
		$email_address = $_GET['inputEmailAddress'];
		$image = 'assets/images/' . $_GET['inputPicture'];
		$this->contacts->addContacts($first_name, $last_name, $contact_number, $address, $email_address, $image);

		$data['title'] = 'Address Book';
		$data['contacts_info'] = $this->contacts->getContacts();
		$this->load->view('home', $data);

	}

	public function search(){		
		$this->load->model('contacts');
		$data['title'] = 'Address Book';
		$search = $_GET['search'];
		$data['contacts_info'] = $this->contacts->searchContact($search);
		$this->load->view('home', $data);
	}

	public function delete(){
		$this->load->model('contacts');
		$id = $_GET['contact_id'];
		$this->contacts->deleteContact($id);

		$data['title'] = 'Address Book';
		$data['contacts_info'] = $this->contacts->getContacts();
		$this->load->view('home', $data);
	}
}
?>
