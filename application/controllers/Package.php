<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Package extends Frontend_Controller {


	/**
	 *
	 */
	public function __construct(){
		parent::__construct();
		

		//$this->load->model('Courses_Has_Chapters_Model');
	}

	public function index(){
		$this->data['packages'] = $this->Package_Model->get_all();
		$this->data['page_content'] = 'packages/list';
		$this->load->view('student/template', $this->data);
	}
	
	/* When user come directly from course */
	public function course($course_id=0){
		$this->data['package_having_course'] = $this->Package_Model->package_having_course($course_id);
		//print_r($this->data['package_having_course']);die;
		$this->data['packages'] = $this->Package_Model->get_all();
		$this->data['course_id'] = $course_id;
		
		$this->data['page_content'] = 'packages/all_packages';
		$this->load->view('student/template', $this->data);
	}
	
	public function pay(){
		 $this->load->library('stripe');
		$token_id = $this->input->post('stripeToken');
		$package_id = $this->input->post('package_id');
		
		// Get price based on package id
		$res = $this->Package_Model->get_package_id($package_id);
		$price = $res->package_price;
		$package_title = $res->package_title;
		$package_duration = $res->package_duration;
		
		$stripe_price = number_format($price) * 100 ;
		
		$data = array(
			'amount' => $stripe_price,
			'source' => $token_id ,
			'description' => $package_title
		);
		
		$response = $this->stripe->addCharge($data);
		$order_data['user_id'] = $this->data['loggedin_user']->user_id;
		$order_data['txn_id'] = $response->id;
		$order_data['token_id'] =  $token_id;
		$order_data['package_id'] = $package_id;
		$order_data['stripe_email'] = $this->input->post('stripeEmail');
		$order_data['payment_status'] = $response->paid;
		
		$order_id = $this->Package_Model->save_order($order_data);
		
		$duration = "+".$package_duration." month";
		$start_duration = date('Y-m-d');
		$end_duration = strtotime($start_duration);
		$end_duration = date('Y-m-d' , strtotime($duration, $end_duration) );
		
		$package_data['user_id'] = $this->data['loggedin_user']->user_id;
		$package_data['package_id'] = $package_id;
		$package_data['order_id'] = $order_id;
		$package_data['duration'] = $package_duration;
		$package_data['start_duration'] = $start_duration;
		$package_data['end_duration'] = $end_duration;
		
		// Get Package Courses
		$result = $this->Package_Tool_Model->get_package_course($package_id);
		$allowed_courses = array();
		if($result){
			foreach($result as $c){
				$allowed_courses[] = $c['package_courses']; 
			}
		}
		
		if($allowed_courses){
			$package_data['allowed_courses']= json_encode($allowed_courses);
		}else{
			$package_data['allowed_courses'] = '';
		}
		
		$this->Package_Model->save_subscription($package_data);
		
		if (isset($response->paid) && ($response->paid) ) {
			$this->success($response->id);
        } else {
			$this->failed($response->id);
        }
	}
	
	public function success($response_id){
		$this->data['transaction_id'] = $response_id;
		$this->data['page_content'] = 'packages/success';
		$this->load->view('student/template', $this->data);
	}
	
	public function failed($response_id){
		$this->data['transaction_id'] = $response_id;
		$this->data['page_content'] = 'packages/failed';
		$this->load->view('student/template', $this->data);
	}
	
	public function myPackages(){
		$user_id = isset($this->data['loggedin_user']->user_id) ? $this->data['loggedin_user']->user_id : 0; ;
		$this->data['packages'] = get_package_name($user_id );
		
		//print_r($this->data['packages']);die;
		$this->data['page_content'] = 'packages/my_packages';
		$this->load->view('student/template', $this->data);
	}
	
}
