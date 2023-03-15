<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Course_Tools_Model extends MY_Model{

	public $table_name = 'course_tools';
    public $primary_key = 'course_tool_id';

    /**
     *
     */
    public function __construct() {
        parent::__construct();
    }

    public function get_by_course($course_id){
    	$result = $this->db->where(array(
    		'course_tool_course_id' => $course_id
    	))->order_by('course_tool_order')->get($this->table_name)->result_array();

    	return $result;
    }

	public function get_course_tools($course_id){
    	$tools = $this->db->where(array(
    		'course_tool_course_id' => $course_id
    	))->order_by('course_tool_order')->get($this->table_name)->result_array();

		foreach($tools as $k=>$tool){
			switch ($tool['course_tool_object']) {
				case 'chapter':
					$tools[$k]['object'] = $this->Chapter_Model->get_chapter_with_tools($tool['course_tool_object_id']);
				break;

				case 'quiz':
					$tools[$k]['object'] = $this->Quiz_Model->get($tool['course_tool_object_id']);
				break;

				case 'lesson':
					$tools[$k]['object'] = $this->Lesson_Model->get($tool['course_tool_object_id']);
				break;

				case 'lesson_and_quiz':
					$tools[$k]['object'] = $this->Lesson_Quiz_Model->get_with_lesson_with_quiz_id($tool['course_tool_object_id']);
				break;

			}
		}

    	return $tools;
    }

}
