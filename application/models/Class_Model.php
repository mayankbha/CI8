<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Class_Model extends MY_Model{
	
	public $table_name = 'class';
    public $primary_key = 'class_id';

    /**
     * 
     */
    public function __construct() {
        parent::__construct();
    }

     public function get_class_by_id($id){
         $result =$this->db->where(array(
            'class_id' => $id
        ))->select('class_name,class_id')->get($this->table_name)->result();

        return $result;
    }


    
}