<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chapter_Tools_Model extends MY_Model{

	public $table_name = 'chapter_tools';
    public $primary_key = 'chapter_tool_id';

    /**
     *
     */
    public function __construct() {
        parent::__construct();
    }

    public function get_by_lesson($lesson_id){
    	$result = $this->db->where(array(
    		'chapter_tool_chapter_id' => $lesson_id
    	))->order_by('chapter_tool_order')->get($this->table_name)->result_array();

    	return $result;
    }

	public function get_chapter_tools($chapter_id){
    	$tools = $this->db->where(array(
    		'chapter_tool_chapter_id' => $chapter_id
    	))->order_by('chapter_tool_order')->get($this->table_name)->result_array();

		foreach($tools as $k=>$tool){
			switch ($tool['chapter_tool_object']) {
				case 'quiz':
					$tools[$k]['object'] = $this->Quiz_Model->get($tool['chapter_tool_object_id']);
				break;

				case 'lesson':
					$tools[$k]['object'] = $this->Lesson_Model->get($tool['chapter_tool_object_id']);
				break;

				case 'lesson_and_quiz':
					$tools[$k]['object'] = $this->Lesson_Quiz_Model->get_with_lesson_with_quiz_id($tool['chapter_tool_object_id']);
				break;
			}
		}

    	return $tools;
    }

	public function get_next_tool($tool_id, $chapter_id){
		$query = "select * from $this->table_name where chapter_tool_id>$tool_id and chapter_tool_chapter_id=$chapter_id LIMIT 1";
		$result = $this->db->query($query)->row();
		$result = json_decode(json_encode($result), true);

		switch ($result['chapter_tool_object']) {
			case 'quiz':
				$result['object'] = $this->Quiz_Model->get($result['chapter_tool_object_id']);
			break;
			
			case 'lesson':
				$result['object'] = $this->Lesson_Model->get($result['chapter_tool_object_id']);
			break;

			case 'lesson_and_quiz':
				$result['object'] = $this->Lesson_Quiz_Model->get_with_lesson_with_quiz_id($result['chapter_tool_object_id']);
			break;
		}

		return json_decode(json_encode($result));
	}
	
	public function get_course_count($course_id){
		$count = $this->db->where(['courses_has_chapters_course_id'=>$course_id])->from('courses_has_chapters')->count_all_results();
		if($count){return $count;}else{return false;}
	}

	public function get_chapter_tool($chapter_tool_chapter_id, $chapter_tool_object_id){
    	$result = $this->db->where(array('chapter_tool_chapter_id' => $chapter_tool_chapter_id, 'chapter_tool_object_id' => $chapter_tool_object_id))->order_by('chapter_tool_order')->get($this->table_name)->row();

    	return $result;
    }

}
