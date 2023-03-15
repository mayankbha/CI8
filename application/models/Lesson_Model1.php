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

    public function getLesson($id){
    	return $data = $this->db->get_where($this->table_name, ['lesson_id'=>$id])->row();
    }

    public function get_all_lesson(){
    	$query = " SELECT * FROM lessons where lesson_status=0";

       return $this->db->query($query)->result();

    }  
    
    

    public function getChapterByLessonId($id){
        $query = " SELECT * FROM chapters where fk_lesson_id=$id";

       return $this->db->query($query)->result();

    }
    
    
    
    
    
    public function deleteLesson($id){
    			//$data = ['lesson_status'=>1];
        $this->db->delete('chapters', array('fk_lesson_id' => $id));

        $this->db->where('lesson_id', $id);
        return $this->db->delete($this->table_name);


    }
    public function updateLesson($data,$id){
    	
    	 $this->db->where('lesson_id', $id);
        return $this->db->update($this->table_name, $data);

    }

  }