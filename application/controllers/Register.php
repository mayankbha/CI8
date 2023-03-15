<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends MY_Controller {


	/**
	 *
	 */
	public function __construct(){
		parent::__construct();

		$this->load->model('User_Model');
	}

	/**
	 * Index Page for this controller.
	 *
	 */
	public function index(){

		$this->load->library('form_validation');

		$this->form_validation->set_rules('user_first_name', 'First Name', 'required');
		$this->form_validation->set_rules('user_last_name', 'Last Name', 'required');
		$this->form_validation->set_rules('user_pword', 'Password', 'required');
		$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[user_pword]');
		$this->form_validation->set_rules('user_email', 'Email', 'required|is_unique[users.user_email]');
		$this->form_validation->set_rules('user_type', 'Type', 'required');

        if ($this->form_validation->run() == FALSE){

        }
        else{
			$data = $this->input->post(
				array(
					'user_first_name',
					'user_last_name',
					'user_email',
					'user_pword',
					'user_type'
				)
			);

			//create user
			if($insert_id = $this->User_Model->insert($data)){
				$this->session->set_flashdata('success', 'Registred successfully.');

				$udata = array(
					'email' => $this->input->post('user_email'),
					'password' => $this->input->post('user_pword')
				);
				$login_returned = $this->User_Model->login($udata);

				if($this->input->post('user_type') == 'student'){
					redirect(base_url('student/account'));
				}elseif($this->input->post('user_type') == 'parent'){
					//redirect(base_url('parent/account'));
					redirect(base_url('page/parent_account'));
				}
			}else{
				$this->session->set_flashdata('danger', 'Error occured!');
			}

		}

		$this->data['page_title'] = $this->data['page_title'] . ' | Register';
		$this->load->view('register', $this->data);
	}
}
