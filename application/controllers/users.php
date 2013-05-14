<?php
class Users extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('users_model');
	}
	
	public function index()
	{
		$data['users'] = $this->users_model->get_users();
		$data['title'] = '用户';
		
		$this->load->view('templates/header', $data);
		$this->load->view('users/index', $data);
		$this->load->view('templates/footer');
	}
	
	public function create()
	{
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		$data['title'] = '创建新用户';
		
		$this->form_validation->set_rules('email', '电子邮件', 'required|valid_email|is_unique[users.email]');
		$this->form_validation->set_rules('password', '密码', 'required');
		$this->form_validation->set_rules('confirmpwd', '确认密码', 'required|matches[password]');
		
		if($this->form_validation->run() === FALSE)
		{
			$this->load->view('templates/header', $data);
			$this->load->view('users/create');
			$this->load->view('templates/footer');
		}
		else
		{
			$this->users_model->set_users();
			redirect('users');
		}
	}
	
	public function edit($id = FALSE)
	{
		$this->load->helper('form');
		$this->load->library('form_validation');
	
		$data['title'] = '编辑用户';
		
		if($id !== FALSE)
		{
			$data['user'] = $this->users_model->get_users($id);
			$data['rule'] = array (
				'0' => '管理员',
				'1' => '试题管理员',
				'2' => '试题录入员',
			);
			$this->load->view('templates/header', $data);
			$this->load->view('users/edit', $data);
			$this->load->view('templates/footer');
		}
		else
		{
			if ($this->form_validation->run() === FALSE) 
			{
				$this->load->view('templates/header', $data);
				$this->load->view('users/edit');
				$this->load->view('templates/footer');
			}
			else
			{
				$this->users_model->eidt_user();
				redirect('users');
			}
		}
	}
	
	public function changepwd($id = FALSE)
	{
		$this->load->helper('form');
		$this->load->library('form_validation');
	
		$data['title'] = '重置密码';
		
		$this->form_validation->set_rules('password', '密码', 'required');
		$this->form_validation->set_rules('confirmpwd', '确认密码', 'required|matches[password]');

		if ($this->form_validation->run() === FALSE) 
		{
			$data['id'] = $id;
			$this->load->view('templates/header', $data);
			$this->load->view('users/changepwd', $data);
			$this->load->view('templates/footer');
		}
		else
		{
			$this->users_model->changepwd($id);
			redirect('users');
		}
	}
	
	public function disable($id = FALSE, $status = FALSE)
	{
		if ($id !== FALSE && $status !== FALSE)
		{
			$this->users_model->disable_user($id, $status);
		}
		redirect('users');
	}
	
	public function delete($id = FALSE)
	{
		if ($id !== FALSE)
		{
			$this->users_model->del_user($id);
		}
		redirect('users');
	}
}