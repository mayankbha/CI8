<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lesson_Model extends MY_Model{

	public $table_name = 'lessons';
    public $primary_key = 'lesson_id';

    /**
     *
     */
    public function __construct() {
        parent::__construct();
    }

    public function getallLesson(){
      $query = " SELECT * FROM chapters";

       return $this->db->query($query)->result();
    }

     public function getLesson($id){
        return $data = $this->db->get_where($this->table_name, ['fk_chapter_id'=>$id])->result();
    }

    public function get_all_chapter(){
      $query = " SELECT * FROM lessons as le LEFT JOIN chapters as ch ON le.fk_chapter_id=ch.chapter_id";

       return $this->db->query($query)->result();

    }



    public function search_lessons_by_chapter_id($chapter_id){
      	$this->db->join('chapter_tools', 'chapter_tools.chapter_tool_object_id='.$this->table_name.'.lesson_id');
		$this->db->where(array(
			'chapter_tool_chapter_id'	=> $chapter_id,
			'chapter_tool_object'		=> 'lesson'
		));

		$result = $this->db->get($this->table_name)->result_array();

		foreach($result as $k=>$lesson){
			$query = 'select chapter_id,chapter_title from chapter_tools join chapters on (chapters.chapter_id=chapter_tools.chapter_tool_chapter_id) where chapter_tool_object="lesson" and chapter_tool_object_id="'.$lesson['lesson_id'].'"';
			$result[$k]['chapters'] = $this->db->query($query)->result_array();
		}

		return $result;
    }

    public function getChapterById($id){

              $query = " SELECT le.lesson_sort_order,le.lesson_id,le.lesson_title,le.lesson_description,cs.chapter_id,cs.chapter_title FROM lessons AS le LEFT JOIN chapters as cs  ON cs.chapter_id=le.fk_chapter_id where lesson_id=$id";

             return $this->db->query($query)->row();
    }

    public function deleteLesson($id){

        $this->db->where('lesson_id', $id);
        return $this->db->delete($this->table_name);

    }

    public function updateLesson($data,$id){

       $this->db->where('lesson_id', $id);
        return $this->db->update($this->table_name, $data);

    }

	public function get_lesson_with_chapter(){
		$lessons = $this->get_all();

		foreach($lessons as $k=>$lesson){
			$query = 'select chapter_id,chapter_title from chapter_tools join chapters on (chapters.chapter_id=chapter_tools.chapter_tool_chapter_id) where chapter_tool_object="lesson" and chapter_tool_object_id="'.$lesson['lesson_id'].'"';
			$lessons[$k]['chapters'] = $this->db->query($query)->result_array();
		}

		return $lessons;
	}

	public function get_all_active(){
		return $this->get_all('', array(
			'lesson_and_quiz_status' => 1
		));
	}
}
