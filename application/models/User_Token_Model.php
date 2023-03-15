<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_Token_Model extends MY_Model{
	
	public $table_name = 'user_tokens';
    public $primary_key = 'user_token_id';

    /**
     * 
     */
    public function __construct() {
        parent::__construct();
    }
    
}