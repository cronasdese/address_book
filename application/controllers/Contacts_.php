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
		$image;
		if(isset($_POST['inputPicture'])){
			if(getimagesize($_FILES['image']['tmp_name']) == FALSE){
				//please select image
			}
			else{
				$image = addslashes($_FILES['image']['tmp_name']);
				$name = addslashes($_FILES['image']['name']);
				$image = file_get_contents($image);
				$image = base64_encode($image);
			}
		}
		/*$last_name = $this->input->post('inputLastName');
		$contact_number = $this->input->post('inputContactNumber');
		$address = $this->input->post('inputAddress');
		$email_address = $this->input->post('inputEmailAddress');
		$picture = $this->input->post('inputPicture');*/

		$data['first_name'] = $this->filter_input($first_name);
		$data['last_name'] = $this->filter_input($last_name);
		$data['contact_number'] = $this->filter_input($contact_number);
		$data['address'] = $this->filter_input($address);
		$data['email_address'] = $this->filter_input($email_address);
		$data['picture'] = $image;
		
		$this->contacts->addContacts($first_name, $last_name, $contact_number, $address, $email_address, $image);
		$this->db->affected_rows();

		$data['title'] = 'Address Book';
		$data['contacts_info'] = $this->contacts->getContacts();
		$this->load->view('home', $data);

		/*$this->load->library('form_validation');

		$this->form_validation->set_rules('inputFirstName', 'First Name', 'trim|required|max_length[35]');
		$this->form_validation->set_rules('inputLastName', 'Last Name', 'trim|required|max_length[35]');
		$this->form_validation->set_rules('inputContactNumber', 'Contact Number', 'trim|required|exact_length[11]');
		$this->form_validation->set_rules('inputAddress', 'Address', 'trim|required');
		$this->form_validation->set_rules('inputEmailAddress', 'Email Address', 'trim|required|valid_email');

		if($this->form_validation->run() == FALSE){

		}

		else{			
			$this->load->model('contacts');
			$this->contacts->addContacts($first_name, $last_name, $contact_number, $address, $email_address);
			$data['title'] = 'Address Book';
			$data['contacts_info'] = $this->contacts->getContacts();
			$this->load->view('home', $data);
		}*/
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
