<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends Frontend_Controller {

	public $data = array();

	public function index(){
		$this->data['testimonials'] = $this->Testimonial_Model->get_all();
		$this->data['all_news'] = $this->News_Model->get_all();
		$this->data['page_content'] = 'home';
		$this->load->view('home_template', $this->data);
	}

	public function about(){
		$this->data['page_content'] = 'about';
		$this->load->view('home_template', $this->data);
	}

	public function contact(){
		$this->data['page_content'] = 'contact';
		$this->load->view('home_template', $this->data);
	}
	
	public function parent_account(){
		
		if ( !$this->session->userdata('loggedin') ){
			redirect(base_url('login'));
		}
		$this->data['page_content'] = 'parents_account';
		$this->load->view('home_template', $this->data);
	}

}
