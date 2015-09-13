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
		$this->load->library('form_validation');

		$first_name = $_GET['inputFirstName'];
		$last_name = $_GET['inputLastName'];
		$contact_number = $_GET['inputContactNumber'];
		$address = $_GET['inputAddress'];
		$email_address = $_GET['inputEmailAddress'];
		
		$this->form_validation->set_rules('inputFirstName', 'First Name', 'required|max_length[35]');
		$this->form_validation->set_rules('inputLastName', 'Last Name', 'required|max_length[35]');
		$this->form_validation->set_rules('inputContactNumber', 'Contact Number', 'required|exact_length[11]|numeric');
		$this->form_validation->set_rules('inputAddress', 'Address', 'required|min_length[5]|max_length[255]');
		$this->form_validation->set_rules('inputEmailAddress', 'Email Address', 'required|min_length[10]|max_length[255]|valid_email');

		if($this->form_validation->run() == TRUE){
			if(!isset($_GET['inputPicture'])){
				$this->contacts->addContactsNoPic($first_name, $last_name, $contact_number, $address, $email_address);
			}
			else{
				$image = 'assets/images/' . $_GET['inputPicture'];
				$this->contacts->addContacts($first_name, $last_name, $contact_number, $address, $email_address, $image);
			}

			$data['title'] = 'Address Book';
			$data['contacts_info'] = $this->contacts->getContacts();
			$this->load->view('home', $data);
			redirect();
		}
		else{
			$data['title'] = 'Address Book';
			$data['err_add'] = 1;
			$data['contacts_info'] = $this->contacts->getContacts();
			$this->load->view('home', $data);
			redirect();
		}

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
		$id = $_GET['inputID'];
		$this->contacts->deleteContact($id);

		$data['title'] = 'Address Book';
		$data['contacts_info'] = $this->contacts->getContacts();
		$this->load->view('home', $data);
		redirect();
	}

	public function update(){
		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->load->model('contacts');

		$first_name = $_GET['inputFirstName'];
		$last_name = $_GET['inputLastName'];
		$contact_number = $_GET['inputContactNumber'];
		$address = $_GET['inputAddress'];
		$email_address = $_GET['inputEmailAddress'];
		$id = $_GET['inputID'];

		$this->form_validation->set_rules('inputFirstName', 'First Name', 'required|max_length[35]');
		$this->form_validation->set_rules('inputLastName', 'Last Name', 'required|max_length[35]');
		$this->form_validation->set_rules('inputContactNumber', 'Contact Number', 'required|exact_length[11]|numeric');
		$this->form_validation->set_rules('inputAddress', 'Address', 'required|min_length[5]|max_length[255]');
		$this->form_validation->set_rules('inputEmailAddress', 'Email Address', 'required|min_length[10]|max_length[255]|valid_email');

		if($this->form_validation->run() == TRUE){
			if(!isset($_GET['inputPicture'])){
				$this->contacts->updateContactNoPic($id, $first_name, $last_name, $contact_number, $address, $email_address);
			}
			else{
				$image = 'assets/images/' . $_GET['inputPicture'];
				$this->contacts->updateContact($id, $first_name, $last_name, $contact_number, $address, $email_address, $image);
			}

			$data['title'] = 'Address Book';
			$data['contacts_info'] = $this->contacts->getContacts();
			$this->load->view('home', $data);
			redirect();
		}
		else{
			$data['title'] = 'Address Book';
			$data['contacts_info'] = $this->contacts->getContacts();
			$this->load->view('home', $data);
			redirect();
		}
	}
}
?>
