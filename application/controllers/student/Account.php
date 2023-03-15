<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends MY_Controller {


	/**
	 *
	 */
	public function __construct(){
		parent::__construct();
	}

	public function index(){
		$this->data['student_name'] = $this->data['loggedin_user']->user_first_name.' '.$this->data['loggedin_user']->user_last_name ;
		$this->data['student_class'] = $this->data['loggedin_user']->student_class ;
		$this->data['user_id'] = isset($this->data['loggedin_user']->user_id) ? $this->data['loggedin_user']->user_id : 0; ;
		$this->data['page_title'] = $this->data['page_title'] . ' | Account';
		$this->data['page_content'] = 'student/account';
		$this->load->view('student/template', $this->data);
	}

	/**
	 *
	 */
	public function logout(){
		$this->session->unset_userdata(array('id', 'email', 'loggedin'));
		$newdata = array(
			'loggedin' => FALSE
		);
		$this->session->set_userdata($newdata);

		redirect('/login');
	}
}
