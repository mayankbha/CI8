<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller {


	/**
	 *
	 */
	public function __construct(){
		parent::__construct();
	}

	public function index()
	{
		if(isset($_POST['login'])){

			$data = array(
				'email' => $this->input->post('email'),
				'password' => $this->input->post('password')
			);

			if($login_returned = $this->User_Model->login_admin($data)){
				redirect(base_url('admin/dashboard'));
			}else{
				$this->session->set_flashdata('danger', 'Credentials mismatch!');
			}
		}

		$this->data['page_title'] = $this->data['page_title'] . ' | Login';
		$this->load->view('admin/login', $this->data);
	}
}
