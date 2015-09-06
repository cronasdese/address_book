<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
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
