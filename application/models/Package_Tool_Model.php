<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Package_Tool_Model extends MY_Model{
	
	public $table_name = 'package_tools';
    public $primary_key = 'package_tool_id';

    /**
     * 
     */
    public function __construct() {
        parent::__construct();
    }

    public function get_category_by_id($id){
    	 $result =$this->db->where(array(
    		'package_id' => $id
    	))->select('c.category_title,package_tools.package_category')->join("categories AS c",'package_tools.package_category=c.category_id','left')->get($this->table_name)->result_array();

    	return $result;
    }     

     public function get_course_by_id($id){
    	 $result =$this->db->where(array(
    		'package_id' => $id
    	))->select('c.course_title,package_tools.package_courses')->join("courses AS c",'package_tools.package_courses=c.course_id','left')->get($this->table_name)->result_array();

    	return $result;
    } 

    public function get_class_by_id($id){
    	 $result =$this->db->where(array(
    		'package_id' => $id
    	))->select('c.class_name,package_tools.package_classes')->join("class AS c",'package_tools.package_classes=c.class_id','left')->get($this->table_name)->result_array();

    	return $result;
    } 
    public function delete_package($id){
        $this->db->where('package_id', $id);

        return $this->db->delete($this->table_name);

    }
	
	public function get_package_course($id){
    	 $result =$this->db->where(array(
    		'package_id' => $id
    	))->select('package_courses')->get($this->table_name)->result_array();

    	return $result;
    } 
	
}