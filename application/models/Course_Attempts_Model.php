<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Course_Attempts_Model extends MY_Model{

	public $table_name = 'course_attempts';
    public $primary_key = 'course_attempt_id';

    /**
     *
     */
    public function __construct() {
        parent::__construct();
    }

	public function log_attempt($course_id, $user_id, $chapter_id){
		$log = $this->course_chapter_log_exists($course_id, $user_id, $chapter_id);
		if(!empty($log)){
			$course_attempt_chapters = json_decode($log->course_attempt_chapters, true);

			if(!in_array($chapter_id, $course_attempt_chapters))
				$this->db->set('course_attempt_current_chapter', $chapter_id);

			array_push($course_attempt_chapters, $chapter_id);
			$course_attempt_chapters = array_unique($course_attempt_chapters);

			$where = array(
				'course_attempt_course_id' => $course_id,
				'course_attempt_user_id' => $user_id,
			);

			//$this->db->set('course_attempt_chapters', json_encode($course_attempt_chapters));
			if(!in_array($chapter_id, $course_attempt_chapters))
			$this->db->where($where)->update($this->table_name);

			$attempt_id = $log->course_attempt_id;
		}else{
			$data = array(
				'course_attempt_course_id' => $course_id,
				'course_attempt_user_id' => $user_id,
				'course_attempt_chapters' => json_encode(array($chapter_id)),
				'course_attempt_current_chapter' => $chapter_id
			);
			$attempt_id = $this->insert($data);
		}
		$this->db->reset_query();
		return $attempt_id;

	}

	public function course_chapter_log_exists($course_id, $user_id, $chapter_id){
		$query = 'select * from '.$this->table_name.' where course_attempt_course_id="'.$course_id.'" and course_attempt_user_id="'.$user_id.'" or course_attempt_current_chapter="'.$chapter_id.'" or JSON_SEARCH(course_attempt_chapters, "all", "%'.$chapter_id.'%") IS NOT NULL limit 1';

		return $result = $this->db->query($query)->row();

	}

}
