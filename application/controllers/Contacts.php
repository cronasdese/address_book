<?php
class Contacts extends CI_Controller {

	function __construct(){
		parent::__construct(); // Call the model constructor
		$this->load->helper('url');
		$this->load->model('contacts_model');
		$this->load->library('form_validation');

		//for file upload
		$config['upload_path'] = './assets/images';
		$config['allowed_types'] = 'gif|jpg|png';
		$this->load->library('upload', $config);
	}

	public function index(){
		$this->home();
	}

	public function home(){
		$data['title'] = 'Address Book';
		$data['contacts_info'] = $this->contacts_model->getContacts();
		$data['err'] = FALSE;
		$data['add'] = FALSE;
		$this->load->view('home', $data);
	}

	public function addcontact(){
		$first_name = $this->input->post('inputFirstName');
		$last_name = $this->input->post('inputLastName');
		$contact_number = $this->input->post('inputContactNumber');
		$address = $this->input->post('inputAddress');
		$email_address = $this->input->post('inputEmailAddress');

		$this->form_validation->set_rules('inputFirstName', 'First Name', 'required|max_length[35]');
		$this->form_validation->set_rules('inputLastName', 'Last Name', 'required|max_length[35]');
		$this->form_validation->set_rules('inputContactNumber', 'Contact Number', 'required|exact_length[11]|numeric');
		$this->form_validation->set_rules('inputAddress', 'Address', 'required|min_length[5]|max_length[255]');
		$this->form_validation->set_rules('inputEmailAddress', 'Email Address', 'required|min_length[10]|max_length[255]|valid_email');

		if($this->form_validation->run() == FALSE){
			$data['title'] = 'Address Book';
			$data['contacts_info'] = $this->contacts_model->getContacts();
			$data['err'] = TRUE;
			$data['add'] = FALSE;
			$this->load->view('home', $data);
		}
		else{
			$duplicate = $this->contacts_model->searchContact($contact_number);
			if($duplicate != NULL){
				$data['title'] = 'Address Book';
				$data['contacts_info'] = $this->contacts_model->searchContact($contact_number);
				$data['err'] = TRUE;
				$data['add'] = FALSE;
				$this->load->view('home', $data);
			}
			else{
				if(!$this->upload->do_upload()){
					//if there is no picture selected
					$image = 'assets/images/avatar.png';
					$this->contacts_model->addContacts($first_name, $last_name, $contact_number, $address, $email_address, $image);
				}
				else{
					//to get filename of pic
					$upload_data = $this->upload->data();
					$image_url = $upload_data['file_name'];
					$image = 'assets/images/' . $image_url;
					$this->contacts_model->addContacts($first_name, $last_name, $contact_number, $address, $email_address, $image);
				}
				$data['title'] = 'Address Book';
				$data['contacts_info'] = $this->contacts_model->getContacts();
				$data['added_contact'] = $this->contacts_model->searchContact($contact_number);
				$data['add'] = TRUE;
				$data['err'] = FALSE;
				$this->load->view('home', $data);
			}
		}
	}

	public function search(){		
		$data['title'] = 'Address Book';
		$search = $this->input->get('search');
		$data['err'] = FALSE;
		$data['add'] = FALSE;
		$data['contacts_info'] = $this->contacts_model->searchContact($search);
		$this->load->view('home', $data);
	}

	public function delete(){
		$id = $this->input->get('inputID');
		$this->contacts_model->deleteContact($id);

		$data['title'] = 'Address Book';
		$data['contacts_info'] = $this->contacts_model->getContacts();
		$data['err'] = FALSE;
		$data['add'] = FALSE;
		$this->load->view('home', $data);
	}

	public function update(){
		$first_name = $this->input->post('inputUpdateFirstName');
		$last_name = $this->input->post('inputUpdateLastName');
		$contact_number = $this->input->post('inputUpdateContactNumber');
		$address = $this->input->post('inputUpdateAddress');
		$email_address = $this->input->post('inputUpdateEmailAddress');
		$id = $this->input->post('inputUpdateID');		

		$this->form_validation->set_rules('inputUpdateFirstName', 'First Name', 'required|max_length[35]');
		$this->form_validation->set_rules('inputUpdateLastName', 'Last Name', 'required|max_length[35]');
		$this->form_validation->set_rules('inputUpdateContactNumber', 'Contact Number', 'required|exact_length[11]|numeric');
		$this->form_validation->set_rules('inputUpdateAddress', 'Address', 'required|min_length[5]|max_length[255]');
		$this->form_validation->set_rules('inputUpdateEmailAddress', 'Email Address', 'required|min_length[10]|max_length[255]|valid_email');

		if($this->form_validation->run() == FALSE){
			$data['title'] = 'Address Book';
			$data['contacts_info'] = $this->contacts_model->getContacts();
			$data['err'] = TRUE; 
			$data['add'] = FALSE;
			$this->load->view('home', $data);
		}
		else{
			$duplicate = $this->contacts_model->searchContactUpdateDuplicate($id, $contact_number);
			if($duplicate != NULL){
				$data['title'] = 'Address Book';
				$data['contacts_info'] = $this->contacts_model->searchContact($contact_number);
				$data['err'] = TRUE;
				$data['add'] = FALSE;
				$this->load->view('home', $data);
			}
			else{
				if(!$this->upload->do_upload()){
					//if there is no picture selected
					$this->contacts_model->updateContactNoPic($id, $first_name, $last_name, $contact_number, $address, $email_address);
				}
				else{
					//to get filename of pic
					$upload_data = $this->upload->data();
					$image_url = $upload_data['file_name'];
					$image = 'assets/images/' . $image_url;
					$this->contacts_model->updateContact($id, $first_name, $last_name, $contact_number, $address, $email_address, $image);
				}

				$data['title'] = 'Address Book';
				$data['contacts_info'] = $this->contacts_model->getContacts();
				$data['added_contact'] = $this->contacts_model->searchContact($contact_number);
				$data['err'] = FALSE;
				$data['add'] = TRUE;
				$this->load->view('home', $data);
			}
		}
	}

	public function letterSearch(){
		$data['title'] = 'Address Book';
		$data['err'] = FALSE;
		$data['add'] = FALSE;
		if($_GET['action'] == 'buttonA'){
			$search = 'A';
		}
		else if($_GET['action'] == 'buttonB'){
			$search = 'B';
		}
		else if($_GET['action'] == 'buttonC'){
			$search = 'C';
		}
		else if($_GET['action'] == 'buttonD'){
			$search = 'D';
		}
		else if($_GET['action'] == 'buttonE'){
			$search = 'E';
		}
		else if($_GET['action'] == 'buttonF'){
			$search = 'F';
		}
		else if($_GET['action'] == 'buttonG'){
			$search = 'G';
		}
		else if($_GET['action'] == 'buttonH'){
			$search = 'H';
		}
		else if($_GET['action'] == 'buttonI'){
			$search = 'I';
		}
		else if($_GET['action'] == 'buttonJ'){
			$search = 'J';
		}
		else if($_GET['action'] == 'buttonK'){
			$search = 'K';
		}
		else if($_GET['action'] == 'buttonL'){
			$search = 'L';
		}
		else if($_GET['action'] == 'buttonM'){
			$search = 'M';
		}
		else if($_GET['action'] == 'buttonN'){
			$search = 'N';
		}
		else if($_GET['action'] == 'buttonO'){
			$search = 'O';
		}
		else if($_GET['action'] == 'buttonP'){
			$search = 'P';
		}
		else if($_GET['action'] == 'buttonQ'){
			$search = 'Q';
		}
		else if($_GET['action'] == 'buttonR'){
			$search = 'R';
		}
		else if($_GET['action'] == 'buttonS'){
			$search = 'S';
		}
		else if($_GET['action'] == 'buttonT'){
			$search = 'T';
		}
		else if($_GET['action'] == 'buttonU'){
			$search = 'U';
		}
		else if($_GET['action'] == 'buttonV'){
			$search = 'V';
		}
		else if($_GET['action'] == 'buttonW'){
			$search = 'W';
		}
		else if($_GET['action'] == 'buttonX'){
			$search = 'X';
		}
		else if($_GET['action'] == 'buttonY'){
			$search = 'Y';
		}
		else{
			$search = 'Z';
		}
		$data['contacts_info'] = $this->contacts_model->searchLetterContact($search);
		$this->load->view('home', $data);
	}

}
