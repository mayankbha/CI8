<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Package_Model extends MY_Model{
	
	public $table_name = 'packages';
    public $primary_key = 'package_id';
    public $subscription_table = 'user_subscribed_packages';
    public $order_table = 'order_info';
    public $package_tool_table = 'package_tools';

    /**
     * 
     */
    public function __construct() {
        parent::__construct();
    }

	public function get_package_id($id){
		return $data = $this->db->get_where($this->table_name, ['package_id'=>$id])->row();
	}

	public function update_package($package_id,$data){
	 $this->db->where('package_id', $package_id);
		 return $this->db->update($this->table_name, $data);
		 
	}

	public function save_order($data){
		$this->db->insert($this->order_table, $data); 
		$id = $this->db->insert_id();
		return $id;
	}

	public function save_subscription($data){
		return $this->db->insert($this->subscription_table, $data); 
	}
	
	public function get_user_subscribed_package($userId,$today_date){
		$result =$this->db->where(array(
            'user_id' => $userId,
			'end_duration >=' => $today_date
        ))->select('allowed_courses')->get($this->subscription_table)->result_array();
		//echo $str = $this->db->last_query();
		if(isset($result) && !empty($result)){return $result;}else{return false;}
	}
	
	public function get_package_name($user_id=0){
		$this->db->select($this->table_name.'.package_id,package_title,package_price,start_duration,end_duration');
    	$this->db->join($this->subscription_table, $this->subscription_table.'.package_id='.$this->table_name.'.package_id');
		$this->db->where($this->subscription_table.'.user_id', $user_id);
		$this->db->order_by($this->subscription_table.'.end_duration', 'ASC');
		$result = $this->db->get($this->table_name)->result_array();
		if(isset($result) && !empty($result)){return $result;}else{return false;}
    }
	
	public function package1_having_course($courseId){
		$result =$this->db->where(array(
            'package_courses' => $courseId
        ))->select('*')->get($this->package_tool_table)->result_array();
		//echo $str = $this->db->last_query();
		if(isset($result) && !empty($result)){return $result;}else{return false;}
	}
	
	public function package_having_course($courseId=0){
		$this->db->select($this->table_name.'.*,');
    	$this->db->join($this->package_tool_table, $this->package_tool_table.'.package_id='.$this->table_name.'.package_id');
		$this->db->where($this->package_tool_table.'.package_courses', $courseId);
		//$this->db->order_by($this->package_tool_table.'.end_duration', 'ASC');
		$result = $this->db->get($this->table_name)->result_array();
		if(isset($result) && !empty($result)){return $result;}else{return false;}
    }
	

}