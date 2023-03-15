<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Badge_Model extends MY_Model{

	public $table_name = 'badges';
    public $primary_key = 'badge_id';

    /**
     *
     */
    public function __construct() {
        parent::__construct();
    }

    public function get_badge_by_id($badge_id){
    	$query = " SELECT * FROM badges where badge_id=$badge_id";
	    return $this->db->query($query)->row();
    }

	public function get_active_badges(){
		$result = $this->db->where('badge_status', 1)->get($this->table_name)->result_array();

		return $result;
	}
}
