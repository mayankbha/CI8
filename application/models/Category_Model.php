<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category_Model extends MY_Model{

	public $table_name = 'categories';
    public $primary_key = 'category_id';

    /**
     *
     */
    public function __construct() {
        parent::__construct();
    }
    public function get_category_by_id($id){
    	 $result =$this->db->where(array(
    		'category_id' => $id
    	))->select('category_title,category_id')->get($this->table_name)->result_array();

    	return $result;
    }

	public function get_active_categories(){
		$result = $this->db->where('category_status', 1)->get($this->table_name)->result_array();

		return $result;
	}
}
