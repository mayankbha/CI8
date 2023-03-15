<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {

	
	/**
	 * 
	 */
	public function __construct(){
		parent::__construct();
	}
	
	public function index(){	
		$this->data['page_title'] = $this->data['page_title'] . ' | Login';
		$this->data['page_content'] = 'admin/dashboard';
		$this->load->view('admin/template', $this->data);
	}
}
