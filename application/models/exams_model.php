<?php
class Exams_model extends CI_Model {
	
	public function __construct()
	{
		$this->load->Database();
	}
	
	public function get_exams($id = FALSE)
	{
		$this->db->select('exams.*, users.name as createname');
		$this->db->from('exams')->join('users', 'users.id = exams.createuser');

		if ($id === FALSE)
		{
			$query = $this->db->get();
			return $query->result_array();
		}
		
		$this->db->where('exams.id', $id);
		$query = $this->db->get();
		return $query->row_array();
	}
	
	public function set_exams($exam)
	{	
		$this->db->insert('exams', $exam);
		return $this->db->insert_id();
	}
	
	public function update_exams($exam)
	{
		$this->db->where('id', $exam['id']);
		return $this->db->update('exams', $exam);
	}
	
	public function del_exams($id)
	{
		$this->db->trans_start();
		$this->db->where('tid', $id);
		$this->db->delete('questions');
		$this->db->where('id', $id);
		$this->db->delete('exams');
		$this->db->trans_complete();
	}
}
?>