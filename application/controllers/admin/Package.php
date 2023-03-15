<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Package extends MY_Controller {


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

	   $this->data['packages'] = $this->Package_Model->get_all();
       $this->data['page_content'] = 'admin/package/list';
       $this->load->view('admin/template', $this->data);

	    }

	public function add(){

		if(isset($_POST['save_package'])){
		  $tools = array(
						'package_title' => $this->input->post('package_title'),
						'package_duration' => $this->input->post('package_duration'),
						'package_price'=>$this->input->post('package_price'),
						'package_created_at'=>date("Y-m-d H:i:s"),
					);
		  $insert_id[] = $this->Package_Model->insert($tools);

		  $category=$this->input->post('package_categories');
          $courses=$this->input->post('package_courses');
          $classes=$this->input->post('package_classes');

		    $pass_category = array();
			if($category){
				foreach ($category as $key => $value) {
					$pass_category[] = array($value,$insert_id);
				}
			}
            $arrCategory = array();
		    $keys = array('package_id', 'package_category');
		    foreach($pass_category as $val) {
  	 	     $arrCategory[] = array_combine($keys, array(reset($insert_id), reset($val)));
			 		}


		  //$this->Package_Tool_Model->insert_batch($arrCategory);

   		  $pass_courses = array();
   	 	  foreach ($courses as $key => $value) {

           	$pass_courses[] = array($value,$insert_id);

           }
            $arrCourses = array();
		   $keys = array('package_id', 'package_courses');
		  foreach($pass_courses as $val) {
  		      $arrCourses[] = array_combine($keys, array(reset($insert_id), reset($val)));
				 	}
		   $this->Package_Tool_Model->insert_batch($arrCourses);

		  $pass_classes = array();
		  if($classes){
			 foreach ($classes as $key => $value) {
				$pass_classes[] = array($value,$insert_id);
			}
		}
           $arrClasses = array();
		    $keys = array('package_id', 'package_classes');
		    foreach($pass_classes as $val) {
  		     $arrClasses[] = array_combine($keys, array(reset($insert_id), reset($val)));
				}
		  //$this->Package_Tool_Model->insert_batch($arrClasses);

		   if ($insert_id) {
		   	$this->session->set_flashdata('success', 'Package created successfully.');
				redirect('admin/package', 'refresh');
		  }else{
		   	$this->session->set_flashdata('error', 'Error occured!');
				 redirect('admin/package');
		  }

		}
	$this->data['courses'] = $this->Course_Model->get_all();
	$this->data['classes'] = $this->Class_Model->get_all();
	$this->data['categories'] = $this->Category_Model->get_all();
	$this->data['page_content'] = 'admin/package/add_package';
	$this->load->view('admin/template', $this->data);
   	}

   	public function edit_package($package_id){

   		if(isset($_POST['update_package'])){

		  $tools = array(
						'package_title' => $this->input->post('package_title'),
						'package_duration' => $this->input->post('package_duration'),
						'package_price'=>$this->input->post('package_price'),
						'package_created_at'=>date("Y-m-d H:i:s"),
					);

		  $package_id=$this->input->post('package_id');
		  $id[]=$package_id;
		  $this->Package_Tool_Model->delete_package($package_id);

		  $insert_id[] = $this->Package_Model->update_package($package_id,$tools);



		  $category=$this->input->post('package_categories');
          $courses=$this->input->post('package_courses');
          $classes=$this->input->post('package_classes');

		    $pass_category = array();
            foreach ($category as $key => $value) {

          	$pass_category[] = array($value,$id);

          }
            $arrCategory = array();
		    $keys = array('package_id', 'package_category');
		    foreach($pass_category as $val) {
  	 	     $arrCategory[] = array_combine($keys, array(reset($id), reset($val)));
			 		}


		  $this->Package_Tool_Model->insert_batch($arrCategory);

   		  $pass_courses = array();
   	 	  foreach ($courses as $key => $value) {

           	$pass_courses[] = array($value,$id);

           }
            $arrCourses = array();
		   $keys = array('package_id', 'package_courses');
		  foreach($pass_courses as $val) {
  		      $arrCourses[] = array_combine($keys, array(reset($id), reset($val)));
				 	}
		   $this->Package_Tool_Model->insert_batch($arrCourses);

		  $pass_classes = array();
		 foreach ($classes as $key => $value) {

          	$pass_classes[] = array($value,$id);

        }
           $arrClasses = array();
		    $keys = array('package_id', 'package_classes');
		    foreach($pass_classes as $val) {
  		     $arrClasses[] = array_combine($keys, array(reset($id), reset($val)));
				}
		  $this->Package_Tool_Model->insert_batch($arrClasses);

		   if ($insert_id) {
		   	$this->session->set_flashdata('success', 'Package updated successfully.');
			redirect('admin/package', 'refresh');
		  }else{
		   	$this->session->set_flashdata('error', 'Error occured!');
				 redirect('admin/package');
		  }

		}



    $this->data['category']=$this->Package_Tool_Model->get_category_by_id($package_id);
    $this->data['course']=$this->Package_Tool_Model->get_course_by_id($package_id);
     $this->data['class']=$this->Package_Tool_Model->get_class_by_id($package_id);

   	$this->data['package'] =$this->Package_Model->get_package_id($package_id);
   	$this->data['courses'] = $this->Course_Model->get_all();
	$this->data['classes'] = $this->Class_Model->get_all();
	$this->data['categories'] = $this->Category_Model->get_all();
	$this->data['page_content'] = 'admin/package/edit_package';
	$this->load->view('admin/template', $this->data);

   	}
   	public function delete_package($package_id){
     $this->Package_Tool_Model->delete_package($package_id);
   	 $result=$this->Package_Model->delete($package_id);
   	 if ($result) {
   	 		$this->session->set_flashdata('success', 'Package Deleted successfully.');
			redirect('admin/package', 'refresh');
   	 }else{
   	 	$this->session->set_flashdata('error', 'Error occured!');
				 redirect('admin/package');
   	 }

   	}

}
