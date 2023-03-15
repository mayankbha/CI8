<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chapter_Model extends MY_Model{

	public $table_name = 'chapters';
    public $primary_key = 'chapter_id';

    /**
     *
     */
    public function __construct() {
        parent::__construct();
    }

    public function getChapter($id){
    	return $data = $this->db->get_where($this->table_name, ['chapter_id'=>$id])->row();
    }

    public function get_all_lesson(){
    	$query = " SELECT * FROM lessons where lesson_status=0";

       return $this->db->query($query)->result();

    }

    public function chapter_tools_delete($chapter_id){

        $this->db->delete('chapter_tools', array(
            'chapter_tool_chapter_id'         => $chapter_id,
        ));
    }

    public function getChapterByLessonId($id){
        $query = " SELECT * FROM chapters where chapter_id=$id";

       return $this->db->query($query)->row();

    }

    public function deleteChapter($id){
    			//$data = ['lesson_status'=>1];
        $this->db->delete('lessons', array('fk_chapter_id' => $id));

        $this->db->where('chapter_id', $id);
        return $this->db->delete($this->table_name);


    }
    public function updateChapter($data,$id){

    	 $this->db->where('chapter_id', $id);
        return $this->db->update($this->table_name, $data);

    }

	public function get_chapter_with_tools($chapter_id){
		$result = $this->db->get_where($this->table_name, array($this->primary_key => $chapter_id))->result_array();
		$return = $result[0];
		$return['tools'] = $this->Chapter_Tools_Model->get_chapter_tools($chapter_id);

		return json_decode(json_encode($return));
	}

	public function get_active_chapters(){
		$result = $this->db->where('chapter_status', 1)->get($this->table_name)->result_array();

		return $result;
	}
}
