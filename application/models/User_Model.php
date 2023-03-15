<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_Model extends MY_Model{

	public $table_name = 'users';
    public $primary_key = 'user_id';

    /**
     *
     */
    public function __construct() {
        parent::__construct();
    }

    public function login_admin($prams){
        $result = $this->db->where(array(
            'user_email'        => $prams['email'],
            'user_pword'    => $prams['password'],
            'user_type' => 'admin',
            'user_status' => 1
        ))->order_by($this->primary_key, 'ASC')->limit(1)->get($this->table_name);

        if($result->num_rows() > 0){
            $user = $result->result();

            $newdata = array(
                'id'        => $user[0]->user_id,
                'email'     => $user[0]->user_email,
                'loggedin'  => TRUE
            );

            $this->session->set_userdata($newdata);

            return 1;
        }else{
            return 0;
        }
    }

    public function login($prams){
    	$result = $this->db->where(array(
    		'user_email'		=> $prams['email'],
    		'user_pword'	=> $prams['password'],
            'user_type !=' => 'admin',
    	))->order_by($this->primary_key, 'ASC')->limit(1)->get($this->table_name);

    	if($result->num_rows() > 0){
    		$user = $result->result();

    		$newdata = array(
    			'id'		=> $user[0]->user_id,
    			'email'		=> $user[0]->user_email,
    			'loggedin'	=> TRUE
    		);

    		$this->session->set_userdata($newdata);

    		return 1;
    	}else{
    		return 0;
    	}
    }

	public function get_user_type($user_id){
		$result = $this->db->select('user_type')->where('user_id', $user_id)->get($this->table_name)->row();
		
    	return $result->user_type;
	}

    /**
     *
     * @return stdClass
     */
    public function get_new(){
        $user = new stdClass();
        $user->user_name = '';
        $user->user_company = '';
        $user->user_email = '';
        $user->user_credits = '';
        $user->user_company_logo = '';
        return $user;
    }

    public function check_user($email) {
        $result = $this->db->select('*')->where('user_email', $email)->get($this->table_name)->row();
        
        return $result;
    }

}
