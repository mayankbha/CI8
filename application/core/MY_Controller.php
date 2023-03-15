<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	public $data = array();

	public function __construct(){
    	parent::__construct();

    	$this->data['page_title'] = 'Keen Kids App';

        $this->data['admin_current_url'] = $uri2 = $this->uri->segment(2);
    	$this->data['current_url'] = $uri1 = $this->uri->segment(1);
    	$exception = array(
    		'login',
    		'register',
            'admin/login'
    	);

    	$uri2 = $uri2 == null ? $uri1 : $uri2;

		if($uri1 != null){
	        if(!in_array($uri2, $exception)){
				if ( !$this->session->userdata('loggedin') ){
	                if($this->data['current_url'] == 'admin'){
	                    redirect(base_url('admin/login'));
	                }else{
	                    redirect(base_url('login'));
	                }
		    	}
	    	}
		}


        if ( $this->session->userdata('loggedin') ){
            $this->data['loggedin_user'] = $this->User_Model->get($this->session->userdata('id'));
        }

		$this->data['placeholder'] = $this->model_tool_image->resize('placeholder.png', 100, 100);
  	}
}
