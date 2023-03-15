<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {


	/**
	 *
	 */
	public function __construct(){
		parent::__construct();
	}

	/**
	 * [index description]
	 * @return [type] [description]
	 */
	public function index(){

		$this->data['users'] = $this->User_Model->get_all();

		$this->data['page_title'] = $this->data['page_title'] . ' | All Users';
		$this->data['page_content'] = 'admin/users/list';
		$this->load->view('admin/template', $this->data);
	}

	/**
	 * [add description]
	 */
	public function add(){

		$this->load->library('form_validation');

		$this->form_validation->set_rules('user_first_name', 'First Name', 'required');
		$this->form_validation->set_rules('user_last_name', 'Last Name', 'required');
		$this->form_validation->set_rules('user_pword', 'Password', 'required');
		$this->form_validation->set_rules('user_email', 'Email', 'required|is_unique[users.user_email]');
		$this->form_validation->set_rules('user_type', 'Type', 'required');

        if ($this->form_validation->run() == FALSE){

        }
        else{
            $user_data = $this->input->post(array(
					'user_first_name', 'user_last_name', 'user_email', 'user_pword', 'user_type', 'user_status', 'user_image'
				));

			// ADDED BY DEV TO ADD CLASS FOR STUDENT
			if( $user_data['user_type'] == 'student' ){
				$user_data['student_class'] = $this->input->post('class');
			} 
			$insert_id = $this->User_Model->insert($user_data);

			if($insert_id){
				$this->session->set_flashdata('success', 'User created successfully.');
				redirect('admin/user', 'refresh');
			}else{
				$this->session->set_flashdata('error', 'Error occured!');
			}
        }

		$this->data['page_title'] = $this->data['page_title'] . ' | Users > Add';
		$this->data['page_content'] = 'admin/users/add-user';
		$this->load->view('admin/template', $this->data);
	}

	/**
	 * [edit description]
	 * @param  [type] $user_id [description]
	 * @return [type]          [description]
	 */
	public function edit($user_id){

		if(isset($_POST['save_user'])){
			$user_data = $this->input->post(array(
					'user_first_name', 'user_last_name', 'user_status', 'user_type', 'user_image'
				));

			// ADDED BY DEV TO ADD CLASS FOR STUDENT
			if( $user_data['user_type'] == 'student' ){
				$user_data['student_class'] = $this->input->post('class');
			} 
			
			if(isset($_POST['user_pword'])){
				$user_data['user_pword'] = $this->input->post('user_pword');
			}

			$return = $this->User_Model->update( $user_data, $this->input->post('user_id'));

			if($return){
				$this->session->set_flashdata('success', 'User updated successfully.');
				redirect('admin/user/edit/'.$this->input->post('user_id'), 'refresh');
			}else{
				$this->session->set_flashdata('error', 'Error occured!');
			}
		}

		$this->data['user'] = $this->User_Model->get($user_id);

		$this->data['thumb'] =  $this->model_tool_image->resize($this->data['user']->user_image,100,100);

		$this->data['page_title'] = $this->data['page_title'] . ' | Users > Edit';
		$this->data['page_content'] = 'admin/users/edit-user';
		$this->load->view('admin/template', $this->data);
	}

	/**
	 * [delete description]
	 * @param  [type] $user_id [description]
	 * @return [type]          [description]
	 */
	function delete($user_id){
		$return = $this->User_Model->delete($user_id);
		//$return = false;
		if($return){
			$this->session->set_flashdata('success', 'User deleted successfully.');
		}else{
			$this->session->set_flashdata('error', 'Error occured!');
		}

		redirect('admin/user', 'refresh');
	}
}
