<?php
class Users_model extends CI_Model {
	
	public function __construct()
	{
		$this->load->Database();
// 		$this->output->enable_profiler(TRUE);
	}
	
	public function get_users($id = FALSE)
	{
		if ($id === FALSE)
		{
			$query = $this->db->get('users');
			return $query->result_array();
		}
		
		$query = $this->db->get_where('users', array('id' => $id));
		return $query->row_array();
		
	}
	
	public function set_users()
	{
		//$password = sha1加密
		date_default_timezone_set('PRC');
		$curTime = date('Y-m-d H:i:s');
		if ($this->input->post('changepwd') === 'changepwd')
		{
			$status = 'nologged';
		}
		else
		{
			$status = 'nomal';
		}
		$data = array(
			'email' => $this->input->post('email'),
			'password' => $this->input->post('password'),
			'rule' => $this->input->post('rule'),
			'name' => $this->input->post('name'),
			'phone' => $this->input->post('phone'),
			'createtime' => $curTime,
			'status' => $status,
		);
		
		return $this->db->insert('users', $data);
	}
	
	public function eidt_user()
	{
		$id = $this->input->post('id');
		$data = array(
			'rule' => $this->input->post('rule'),
			'name' => $this->input->post('name'),
			'phone' => $this->input->post('phone')
		);
		
		$this->db->where('id', $id);
		return $this->db->update('users', $data); 
	}
	
	public function changepwd($id)
	{
		$data = array(
			'password' => $this->input->post('password'),
		);
		
		$this->db->where('id', $id);
		return $this->db->update('users', $data); 

	}
	
	public function disable_user($id, $status)
	{
		$data = array(
			'status' => $status,
		);
		
		$this->db->where('id', $id);
		return $this->db->update('users', $data); 

	}
	
	public function del_user($id)
	{
		return $this->db->delete('users', array('id' => $id)); 
	}
}