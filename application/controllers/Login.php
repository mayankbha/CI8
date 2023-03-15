<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends Frontend_Controller {


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

			if($login_returned = $this->User_Model->login($data)){
				if($this->User_Model->get_user_type($this->session->userdata('id')) == 'student'){
					redirect(base_url('student/account'));
				}elseif($this->User_Model->get_user_type($this->session->userdata('id')) == 'parent'){
					//redirect(base_url('parent/account'));
					redirect(base_url('page/parent_account'));
				}
			}else{
				$this->session->set_flashdata('danger', 'Credentials mismatch!');
			}
		}

		$this->data['page_title'] = $this->data['page_title'] . ' | Login';
		$this->load->view('login', $this->data);
	}
	
	/* LOGIN FOR PACKAGE SECTION */
	public function buy($course_id=0)
	{
		if(isset($_POST['login'])){

			$data = array(
				'email' => $this->input->post('email'),
				'password' => $this->input->post('password')
			);

			if($login_returned = $this->User_Model->login($data)){
				redirect(base_url('Package/course/'.$course_id));
			}else{
				$this->session->set_flashdata('danger', 'Credentials mismatch!');
			}
		}
		$this->data['course_id'] = $course_id;
		$this->data['page_title'] = $this->data['page_title'] . ' | Login';
		$this->load->view('login_package', $this->data);
	}

	public function forgotPassword() {
		if(isset($_POST['forgot_password'])) {
			$email = $this->input->post('email');

			if($user_data = $this->User_Model->check_user($email)) {
				$to = $user_data->user_email;
				$from = 'support@keenkid.com';
				$subject = 'Keenkid : Forgot Password Request';
				$body = '<table border="0" width="50%" height="150"><tr><th align="left">Hello '.$user_data->user_first_name.',</th></tr><tr><td>You have requested password for your keenkid account. Please note down the below password.</td></tr><tr><td>Password : '.$user_data->user_pword.'</td></tr><tr><td>Thanks,</td></tr><tr><td>Keenkid Support</td></tr></table>';

				// Always set content-type when sending HTML email
				$headers = "MIME-Version: 1.0" . "\r\n";
				$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

				// More headers
				$headers .= 'From: <'.$from.'>' . "\r\n";
				$headers .= 'Reply-To: <'.$from.'>' . "\r\n";
				$headers .= 'Return-Path: <'.$from.'>' . "\r\n";

				$mail = mail($to, $subject, $body, $headers);

				if($mail)
					$this->session->set_flashdata('success', 'Password has been sent to your email address! If you are unable to find it in Inbox, please check spam folder also and add keenkid to your contact list so further email from keenkid will be deliver to your Inbox only.');
				else
					$this->session->set_flashdata('danger', 'Sorry!!! Email not sent. Please try again later.');
			} else {
				$this->session->set_flashdata('danger', 'Invalid E-mail Address!');
			}
		}

		$this->load->view('forgot_password');
	}

}
