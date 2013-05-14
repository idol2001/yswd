<?php
class Questions_model extends CI_Model {
	
	public function __construct()
	{
		$this->load->Database();
	}
	
	public function get_questions($id)
	{
		$this->db->where('id', $id);
		$query = $this->db->get('questions');
		return $query->row_array();
	}
	
	public function get_questions_by_exam_id($tid)
	{
		$this->db->where('tid', $tid);
		$query = $this->db->get('questions');
		return $query->result_array();
	}
	
	public function set_questions($questions)
	{
		$this->db->insert('questions', $questions);
		return $this->db->insert_id();
	}
	
		
	public function update_questions($questions)
	{
		$this->db->where('id', $questions['id']);
		return $this->db->update('questions', $questions);
	}
}
?>