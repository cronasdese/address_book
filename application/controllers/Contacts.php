<?php
class Contacts extends CI_Controller {

	function __construct(){
		parent::__construct(); // Call the model constructor
		$this->load->helper('url');
		$this->load->model('contacts_model');
		$this->load->library('form_validation');
	}

	public function index(){
		$this->home();
	}

	public function home(){
		$data['title'] = 'Address Book';
		$data['contacts_info'] = $this->contacts_model->getContacts();
		$this->load->view('home', $data);
	}

	public function addcontact(){
		$first_name = $this->input->post('inputFirstName');
		$last_name = $this->input->post('inputLastName');
		$contact_number = $this->input->post('inputContactNumber');
		$address = $this->input->post('inputAddress');
		$email_address = $this->input->post('inputEmailAddress');
		$image_url = $_FILES['inputPicture']['name'];
		//print_r($_FILES); exit;
		$this->form_validation->set_rules('inputFirstName', 'First Name', 'required|max_length[35]');
		$this->form_validation->set_rules('inputLastName', 'Last Name', 'required|max_length[35]');
		$this->form_validation->set_rules('inputContactNumber', 'Contact Number', 'required|exact_length[11]|numeric');
		$this->form_validation->set_rules('inputAddress', 'Address', 'required|min_length[5]|max_length[255]');
		$this->form_validation->set_rules('inputEmailAddress', 'Email Address', 'required|min_length[10]|max_length[255]|valid_email');

		if($this->form_validation->run() == FALSE){
			$data['title'] = 'Address Book';
			$data['contacts_info'] = $this->contacts_model->getContacts();
			$this->load->view('home', $data);
			redirect();
		}
		else{
			if(!isset($_FILES['inputImage'])){
				$this->contacts_model->addContactsNoPic($first_name, $last_name, $contact_number, $address, $email_address);
			}
			else{
				$image = 'assets/images/' . $image_url;
				$this->contacts_model->addContacts($first_name, $last_name, $contact_number, $address, $email_address, $image);
			}

			$data['title'] = 'Address Book';
			$data['contacts_info'] = $this->contacts_model->getContacts();
			$this->load->view('home', $data);
			redirect();
		}
	}

	public function search(){		
		$data['title'] = 'Address Book';
		$search =$this->input->get('search');
		$data['contacts_info'] = $this->contacts_model->searchContact($search);
		$this->load->view('home', $data);
	}

	public function delete(){
		$id = $this->input->get('inputID');
		$this->contacts_model->deleteContact($id);

		$data['title'] = 'Address Book';
		$data['contacts_info'] = $this->contacts_model->getContacts();
		$this->load->view('home', $data);
		redirect();
	}

	public function update(){
		$first_name = $this->input->post('inputFirstName');
		$last_name = $this->input->post('inputLastName');
		$contact_number = $this->input->post('inputContactNumber');
		$address = $this->input->post('inputAddress');
		$email_address = $this->input->post('inputEmailAddress');
		$image_url = $this->input->post('inputPicture');
		$id = $this->input->post('inputID');

		$this->form_validation->set_rules('inputFirstName', 'First Name', 'required|max_length[35]');
		$this->form_validation->set_rules('inputLastName', 'Last Name', 'required|max_length[35]');
		$this->form_validation->set_rules('inputContactNumber', 'Contact Number', 'required|exact_length[11]|numeric');
		$this->form_validation->set_rules('inputAddress', 'Address', 'required|min_length[5]|max_length[255]');
		$this->form_validation->set_rules('inputEmailAddress', 'Email Address', 'required|min_length[10]|max_length[255]|valid_email');

		if($this->form_validation->run() == FALSE){
			$data['title'] = 'Address Book';
			$data['contacts_info'] = $this->contacts_model->getContacts();
			$this->load->view('home', $data);
			redirect();
		}
		else{
			if(!isset($_POST['inputPicture'])){
				$this->contacts_model->updateContactNoPic($id, $first_name, $last_name, $contact_number, $address, $email_address);
			}
			else{
				$image = 'assets/images/' . $image_url;
				$this->contacts_model->updateContact($id, $first_name, $last_name, $contact_number, $address, $email_address, $image);
			}

			$data['title'] = 'Address Book';
			$data['contacts_info'] = $this->contacts_model->getContacts();
			$this->load->view('home', $data);
			redirect();
		}
	}
}
