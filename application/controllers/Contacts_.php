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
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');

		$this->form_validation->set_rules('inputFirstName', 'First Name', 'trim|required|max_length[35]');
		$this->form_validation->set_rules('inputLastName', 'Last Name', 'trim|required|max_length[35]');
		$this->form_validation->set_rules('inputContactNumber', 'Contact Number', 'trim|required|exact_length[11]');
		$this->form_validation->set_rules('inputAddress', 'Address', 'trim|required');
		$this->form_validation->set_rules('inputEmailAddress', 'Email Address', 'trim|required|valid_email');

		if($this->form_validation->run() == FALSE){

		}

		else{
			$this->load->model('contacts');
			$data['title'] = 'Address Book';
			$data['contacts_info'] = $this->contacts->getContacts();
			$this->load->view('home', $data);
		}
	}

	public function search(){

		$this->load->model('contacts');

		$data['title'] = 'Address Book';

		$data['contacts_info'] = $this->contacts->searchContact($_POST);

		$this->load->view('home', $data);
	}
}
?>
