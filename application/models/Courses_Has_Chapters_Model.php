<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Courses_Has_Chapters_Model extends MY_Model{

	public $table_name = 'courses_has_chapters';
    public $primary_key = 'courses_has_chapters_id';

    /**
     *
     */
    public function __construct() {
        parent::__construct();
    }

	public function get_with_chapter($course_id){
		$this->db->join('chapters', 'chapters.chapter_id='.$this->table_name.'.courses_has_chapters_chapter_id');
		$this->db->where($this->table_name.'.courses_has_chapters_course_id', $course_id);

		$result = $this->db->get($this->table_name)->result_array();

		return $result;
	}

	public function get_with_chapter_with_tools($course_id){
		$this->db->join('chapters', 'chapters.chapter_id='.$this->table_name.'.courses_has_chapters_chapter_id');
		$this->db->where($this->table_name.'.courses_has_chapters_course_id', $course_id);

		$result = $this->db->get($this->table_name)->result_array();

		foreach($result as $k=>$chapter){
			$result[$k]['tools'] = $this->Chapter_Tools_Model->get_chapter_tools($chapter['chapter_id']);
		}

		return $result;
	}

	public function get_count_by_course($course_id){
		$this->db->join('chapters', 'chapters.chapter_id='.$this->table_name.'.courses_has_chapters_chapter_id');
		$this->db->where($this->table_name.'.courses_has_chapters_course_id', $course_id);

		return $this->db->count_all_results($this->table_name);

	}

	public function get_next_chapter($course_id, $chapter_id){
		$query = "select * from $this->table_name where courses_has_chapters_id>(select courses_has_chapters_id from $this->table_name where courses_has_chapters_course_id=$course_id and courses_has_chapters_chapter_id=$chapter_id) and courses_has_chapters_course_id=$course_id LIMIT 1";

		return $result = $this->db->query($query)->row();
	}
	
	public function get_chapter_details($course_id){
		$this->db->select('chapter_id, chapter_title');
		$this->db->join('chapters', 'chapters.chapter_id='.$this->table_name.'.courses_has_chapters_chapter_id');
		$this->db->where($this->table_name.'.courses_has_chapters_course_id', $course_id);
		$this->db->where('chapters.chapter_status', 1);

		$result = $this->db->get($this->table_name)->result_array();

		return $result;
	}

}
