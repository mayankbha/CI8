<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('welcome_message');
	}
	
	
	/* Get Table Structure & all tables */
	
	public function table_fields(){
		$fields = $this->db->list_fields('quizzes');
		foreach ($fields as $field)
		{
		   echo "<pre/>";
		   echo $field;
		}
	}
	
	public function all_tables(){
		$tables = $this->db->list_tables();
		foreach ($tables as $table){
			echo "<pre/>";
			echo $table;
		} 
	}
	/* Download DB from server */
	
	public function db_backup(){
		$this->load->dbutil();

		$prefs = array(     
		'format'      => 'zip',             
		'filename'    => 'my_db_backup.sql'
		);
		
		$backup =& $this->dbutil->backup($prefs); 

		$db_name = 'backup-on-'. date("Y-m-d-H-i-s") .'.zip';
		$save = 'pathtobkfolder/'.$db_name;

		$this->load->helper('file');
		write_file($save, $backup);

		$this->load->helper('download');
		force_download($db_name, $backup); 
	}
	
	
}
