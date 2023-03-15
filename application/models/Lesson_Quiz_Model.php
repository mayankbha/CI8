<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lesson_Quiz_Model extends MY_Model{

	public $table_name = ' lesson_and_quiz';
    public $primary_key = ' lesson_and_quiz_id';

    /**
     *
     */
    public function __construct() {
        parent::__construct();
    }

    public function get_all_data(){
    	$query = " SELECT * FROM lesson_and_quiz as lz LEFT JOIN lessons as le ON lz.lesson_and_quiz_lesson_id=le.lesson_id LEFT JOIN quizzes as qz ON lz.lesson_and_quiz_quiz_id=qz.quiz_id";

		return $this->db->query($query)->result();
    }

	public function get_with_lesson_with_quiz(){
		$this->db->select('*, CONCAT(lessons.lesson_title, " and " , quizzes.quiz_title) as lesson_and_quiz_title');
    	$this->db->join('lessons', 'lessons.lesson_id='.$this->table_name.'.lesson_and_quiz_lesson_id');
		$this->db->join('quizzes', 'quizzes.quiz_id='.$this->table_name.'.lesson_and_quiz_quiz_id');

		$return = $this->db->get($this->table_name)->result_array();

		return $return;
    }

	public function get_with_lesson_with_quiz_id($lesson_and_quiz_id){
		$this->db->select('*, CONCAT(lessons.lesson_title, " and " , quizzes.quiz_title) as lesson_and_quiz_title, CONCAT(lessons.lesson_description, "" , quizzes.quiz_description) as lesson_and_quiz_description');
    	$this->db->join('lessons', 'lessons.lesson_id='.$this->table_name.'.lesson_and_quiz_lesson_id');
		$this->db->join('quizzes', 'quizzes.quiz_id='.$this->table_name.'.lesson_and_quiz_quiz_id');
		$this->db->where('lesson_and_quiz_id', $lesson_and_quiz_id);
		$return = $this->db->get($this->table_name)->row();

		return $return;
    }

	    public function edit_lesson($lesson_id){
    	$query = " SELECT * FROM lessons as le
		LEFT JOIN lesson_and_quiz as lz ON lz.lesson_and_quiz_lesson_id=le.lesson_id
		 where lesson_id=$lesson_id";

       return $this->db->query($query)->row();

    }

    public function edit_quiz($quiz_id){
    	$query = " SELECT * FROM quizzes as qz LEFT JOIN lesson_and_quiz as lz ON lz.lesson_and_quiz_quiz_id=qz.quiz_id where quiz_id=$quiz_id";

		return $this->db->query($query)->row();

    }
	
	public function get_next_course_chapter($user_id, $course_id) {
		$query1 = "SELECT * FROM courses_has_chapters WHERE courses_has_chapters_course_id = $course_id";
		$result1 = $this->db->query($query1)->result_array();

		//echo "<pre>"; print_r($result1);

		if(!empty($result1)) {
			$courses_chapters_array = array();
			$next_lesson_array = array();

			foreach($result1 as $key1 => $val1) {
				$course_id = $val1['courses_has_chapters_course_id'];
				$chapter_id = $val1['courses_has_chapters_chapter_id'];

				$query2 = "SELECT * FROM chapter_tools WHERE chapter_tool_chapter_id = $chapter_id";
				$result2 = $this->db->query($query2)->result_array();

				//echo "<pre>"; print_r($result2);

				foreach($result2 as $key2 => $val2) {
					$chapter_tool_object_id = $val2['chapter_tool_object_id'];

					$courses_chapters_array[$val1['courses_has_chapters_chapter_id']][] = $val2;

					$query3 = "SELECT * FROM lesson_and_quiz WHERE lesson_and_quiz_id = $chapter_tool_object_id";
					$result3 = $this->db->query($query3)->result_array();

					//echo "<pre>"; print_r($result3);

					foreach($result3 as $key3 => $val3) {
						$lesson_id = $val3['lesson_and_quiz_lesson_id'];

						$courses_chapters_array[$val1['courses_has_chapters_chapter_id']][$key2]['lesson_and_quiz'] = $val3;

						$query4 = "SELECT * FROM lesson_attempts WHERE lesson_attempt_user_id = $user_id AND lesson_attempt_course_id = $course_id AND lesson_attempt_chapter_id = $chapter_id AND lesson_attempt_lesson_id = $lesson_id AND lesson_attempt_complete_status = 1";
						$result4 = $this->db->query($query4)->row();

						//echo "<pre>"; print_r($result4);

						if(empty($result4)) {
							if(empty($next_lesson_array)) {
								$next_lesson_array['course_id'] = $course_id;
								$next_lesson_array['chapter_id'] = $chapter_id;
								$next_lesson_array['tool_id'] = $val2['chapter_tool_id'];
								$next_lesson_array['lessonquiz'] = $val3['lesson_and_quiz_id'];
								$next_lesson_array['chapter_tool_object'] = $val2['chapter_tool_object'];
							}
						}
					}
				}
			}

			//echo "<pre>"; print_r($courses_chapters_array);
			//echo "<pre>"; print_r($next_lesson_array);
		}

		return $next_lesson_array;
	}

}
