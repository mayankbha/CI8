<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Course_Chapter_Attempts_Model extends MY_Model{

	public $table_name = 'course_chapter_attempts';
    public $primary_key = 'c_c_attempt_id';

    /**
     *
     */
    public function __construct() {
        parent::__construct();
    }

	public function log_attempt($caid, $course_id, $user_id, $chapter_id, $tool_id){
		$log = $this->course_chapter_tool_log_exists($caid, $course_id, $user_id, $chapter_id, $tool_id);
		if(!empty($log)){
			$c_c_attempt_chapter_tools = json_decode($log->c_c_attempt_chapter_tools, true);

			if(!in_array($tool_id, $c_c_attempt_chapter_tools))
				$this->db->set('c_c_attempt_current_tool_id', $tool_id);

			array_push($c_c_attempt_chapter_tools, $tool_id);
			$c_c_attempt_chapter_tools = array_unique($c_c_attempt_chapter_tools);

			$where = array(
				'c_c_attempt_caid' => $caid,
				'c_c_attempt_course_id' => $course_id,
				'c_c_attempt_user_id' => $user_id,
				'c_c_attempt_chapter_id' => $chapter_id,
			);

			$this->db->set('c_c_attempt_chapter_tools', json_encode($c_c_attempt_chapter_tools));
			$this->db->where($where)->update($this->table_name);

			$attempt_id = $log->c_c_attempt_id;
		}else{
			$data = array(
				'c_c_attempt_caid' => $caid,
				'c_c_attempt_course_id' => $course_id,
				'c_c_attempt_user_id' => $user_id,
				'c_c_attempt_chapter_id' => $chapter_id,
				'c_c_attempt_chapter_tools' => json_encode(array($tool_id)),
				'c_c_attempt_current_tool_id' => $tool_id
			);
			$attempt_id = $this->insert($data);
		}
		$this->db->reset_query();
		return $attempt_id;
	}

	public function course_chapter_tool_log_exists($caid, $course_id, $user_id, $chapter_id, $tool_id){
		$query = 'select * from '.$this->table_name.' where c_c_attempt_course_id="'.$course_id.'" and c_c_attempt_user_id="'.$user_id.'" and c_c_attempt_chapter_id="'.$chapter_id.'" and c_c_attempt_caid="'.$caid.'" or c_c_attempt_current_tool_id="'.$chapter_id.'" or JSON_SEARCH(c_c_attempt_chapter_tools, "all", "%'.$tool_id.'%") IS NOT NULL limit 1';

		return $result = $this->db->query($query)->row();
	}

	public function mark_as_complete($c_c_attempt_id){
		$data = array(
			'c_c_attempt_complete_datetime' => date('Y-m-d H:i:s'),
			'c_c_attempt_complete_status' => 1
		);
		$this->update($data, $c_c_attempt_id);
	}

}
