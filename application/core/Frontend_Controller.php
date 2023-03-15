<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Frontend_Controller extends CI_Controller {

	public $data = array();

	public function __construct(){
    	parent::__construct();

    	$this->data['page_title'] = 'Keen Kids App';

        if ( $this->session->userdata('loggedin') ){
            $this->data['loggedin_user'] = $this->User_Model->get($this->session->userdata('id'));
        }
  	}
}
