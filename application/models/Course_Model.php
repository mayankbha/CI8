<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Course_Model extends MY_Model{

	public $table_name = 'courses';
    public $primary_key = 'course_id';

    /**
     *
     */
    public function __construct() {
        parent::__construct();
    }

	public function get_active_all(){
		return $this->db->where('course_status', 1)->get($this->table_name)->result_array();
	}

    public function get_with_categories($course_id){
        $course = $this->get($course_id);
        $course = json_decode(json_encode($course), true);

        $categories_result = $this->db->where(array('courses_course_id' => $course_id))->get('categories_has_courses');
        $course['categories'] = $categories_result->result_array();

        return $course;
    }

    /**
     * [course_categories_insert description]
     * @param  [type] $course_id  [description]
     * @param  [type] $categories [description]
     * @param  [type] $user_id    [description]
     * @return [type]             [description]
     */
    public function course_categories_insert($course_id, $categories, $user_id){
    	$data = array();
    	foreach($categories as $category){
    		$data[] = array(
    			'categories_category_id'	=> $category,
    			'courses_course_id'			=> $course_id,
    			'courses_course_user_id' => $user_id
    		);
    	}
    	$this->db->insert_batch('categories_has_courses', $data);
    }

    /**
     * [course_categories_dalete description]
     * @param  [type] $course_id [description]
     */
    public function course_categories_delete($course_id){

        $this->db->delete('categories_has_courses', array(
            'courses_course_id'         => $course_id,
        ));
    }

	/**
	 *
	 */
	public function course_tools_delete($course_id){

        $this->db->delete('course_tools', array(
            'course_tool_course_id'         => $course_id,
        ));
    }

	/**
	 *
	 */
	public function course_chapters_delete($course_id){

        $this->db->delete('courses_has_chapters', array(
            'courses_has_chapters_course_id'         => $course_id,
        ));

    }

    public function get_course_by_id($id){
        $result =$this->db->where(array(
            'course_id' => $id
        ))->select('course_title,course_id')->get($this->table_name)->result();

        return $result;
    }

	public function get_course_category_ids($course_id){
		$result = $this->db->select('categories_category_id')
			->where(array('courses_course_id' => $course_id))
			->get('categories_has_courses')->result_array();

		$cat_ids = array_column($result, 'categories_category_id');
        return $cat_ids;
	}

	public function get_courses_by_category_ids($cat_ids){
		$result = $this->db->select('courses_course_id')
			->where_in('categories_category_id', $cat_ids)
			->get('categories_has_courses')->result_array();

		$course_ids = array_column($result, 'courses_course_id');
        return array_unique($course_ids);
	}

	public function get_where_in($course_ids){
		$result = $this->db->where_in($this->primary_key, $course_ids)
			->get($this->table_name)->result_array();

        return $result;
	}
	
	// ADD BY DEV A 
	public function get_course_title($course_id){
		$result = $this->db->select('course_title')
			->where(array('course_id' => $course_id))
			->get($this->table_name)->row();
		
		if($result){return $result->course_title;}else{return false;}
	}
	
	public function get_chapter_title($chapter_id){
		$result = $this->db->select('chapter_title')
			->where(array('chapter_id' => $chapter_id))
			->get('chapters')->row();
		
		if($result){return $result->chapter_title;}else{return false;}
	}
	
	public function get_courses(){
		$result = $this->db->select('course_id,course_title,course_badge')
			->where(array('course_status' => 1))
			->get($this->table_name)->result_array();
		
		if($result){return $result;}else{return false;}
	}

}
