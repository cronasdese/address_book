<?php
class Contacts_ extends CI_Controller {

	function __construct(){
		parent::__construct(); // Call the model constructor
		$this->load->helper('url');
		$this->load->model('contacts');
		$this->load->library('form_validation');
	}

	public function index(){
		$this->home();
	}

	public function home(){
		$data['title'] = 'Address Book';
		$data['contacts_info'] = $this->contacts->getContacts();
		$this->load->view('home', $data);
	}

	public function addcontact(){
		
		$first_name = $this->input->get('inputFirstName');
		$last_name = $this->input->get('inputLastName');
		$contact_number = $this->input->get('inputContactNumber');
		$address = $this->input->get('inputAddress');
		$email_address = $this->input->get('inputEmailAddress');
		
		$this->form_validation->set_rules($first_name, 'First Name', 'required|max_length[35]');
		$this->form_validation->set_rules($last_name, 'Last Name', 'required|max_length[35]');
		$this->form_validation->set_rules($contact_number, 'Contact Number', 'required|exact_length[11]|numeric');
		$this->form_validation->set_rules($address, 'Address', 'required|min_length[5]|max_length[255]');
		$this->form_validation->set_rules($email_address, 'Email Address', 'required|min_length[10]|max_length[255]|valid_email');

		if($this->form_validation->run() == TRUE){
			die('asd');
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
		}
		else{
			$data['title'] = 'Address Book';
			$data['err_add'] = 1;
			$data['contacts_info'] = $this->contacts->getContacts();
			$this->load->view('home', $data);
		}

	}

	public function search(){		
		$data['title'] = 'Address Book';
		$search =$this->input->get('search');
		$data['contacts_info'] = $this->contacts->searchContact($search);
		$this->load->view('home', $data);
	}

	public function delete(){
		$id = $this->input->get('inputID');
		$this->contacts->deleteContact($id);

		$data['title'] = 'Address Book';
		$data['contacts_info'] = $this->contacts->getContacts();
		$this->load->view('home', $data);
	}

	public function update(){
		$first_name = $this->input->get('inputFirstName');
		$last_name = $this->input->get('inputLastName');
		$contact_number = $this->input->get('inputContactNumber');
		$address = $this->input->get('inputAddress');
		$email_address = $this->input->get('inputEmailAddress');
		$id = $this->input->get('inputID');

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
		}
		else{
			$data['title'] = 'Address Book';
			$data['contacts_info'] = $this->contacts->getContacts();
			$this->load->view('home', $data);
		}
	}
}
?>
