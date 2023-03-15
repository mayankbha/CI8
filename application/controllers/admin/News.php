<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News extends MY_Controller {

	
	/**
	 * 
	 */
	public function __construct(){
		parent::__construct();
	}
	
	/**
	 * [index description]
	 * @return [type] [description]
	 */
	public function index(){

		if(isset($_POST['save_changes'])){
			$category_data = $this->input->post(array('description', 'status'));

			if(isset($_POST['t_id'])){
				$return = $this->News_Model->update( $category_data, $this->input->post('t_id'));

				if($return){
					$this->session->set_flashdata('success', 'News updated successfully.');
					redirect('admin/news', 'refresh');
				}else{
					$this->session->set_flashdata('error', 'Error occured!');
				}
			}else{
				$insert_id = $this->News_Model->insert($category_data);

				if($insert_id){
					$this->session->set_flashdata('success', 'News created successfully.');
					redirect('admin/news', 'refresh');
				}else{
					$this->session->set_flashdata('error', 'Error occured!');
				}
			}
			
		}

		$this->data['all_news'] = $this->News_Model->get_all();

		if(isset($_GET['nid'])){
			$this->data['news'] = $this->News_Model->get($this->input->get('nid'));
		}

		$this->data['page_title'] = $this->data['page_title'] . ' | All Categories';
		$this->data['page_content'] = 'admin/news/index';
		$this->load->view('admin/template', $this->data);
	}

	/**
	 * [delete description]
	 * @param  [type] $id [description]
	 * @return [type]          [description]
	 */
	function delete($id){
		$return = $this->News_Model->delete($id);
		//$return = false;
		if($return){
			$this->session->set_flashdata('success', 'News deleted successfully.');
		}else{
			$this->session->set_flashdata('error', 'Error occured!');
		}

		redirect('admin/news', 'refresh');
	}
}
