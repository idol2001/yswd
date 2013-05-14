<?php
class Questions extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('exams_model');
		$this->load->model('questions_model');
	}
	
	private function slide_url($id, $tid)
	{
		$dir = $this->config->item('exam_dir');
		return base_url().$dir.'/'.$tid.'/'.$id.'.html';
	}
	
	private function slide_path($id, $tid)
	{
		$base_path = $this->config->item('base_path');
		$dir = $this->config->item('exam_dir');
		return $base_path.'/'.$dir.'/'.$tid.'/'.$id.'.html';
	}
	
	public function create($tid)
	{
		$this->load->helper('form');
		$this->load->library('form_validation');
			
		$data['title'] = '新建题目片段';
		
		$data['question'] = array (
			'id' => '',
			'text' => '',
			'duration' => '',
			'tid' => $tid
		);
		$this->load->view('templates/header', $data);
		$this->load->view('exams/add_question', $data);
		$this->load->view('templates/footer');
	}
	
	public function edit($id)
	{
		$this->load->helper('form');
		$this->load->library('form_validation');
			
		$data['title'] = '编辑题目片段';	
		$data['question'] = $this->questions_model->get_questions($id);

		$this->load->view('templates/header', $data);
		$this->load->view('exams/add_question', $data);
		$this->load->view('templates/footer');
	}
	
	public function save_question()
	{
		$this->load->helper('form');
		$this->load->library('form_validation');

		$question = array (
			'id' => $this->input->post('id'),
			'duration' => $this->input->post('duration'),
			'tid' => $this->input->post('tid'),
		);
		
		$data['title'] = '编辑题目片段';	
		$data['question'] = $question;

		$this->form_validation->set_rules('duration', '时长', 'required');
		
		if($this->form_validation->run() === FALSE)
		{
			$this->load->view('templates/header', $data);
			$this->load->view('exams/add_question', $data);
			$this->load->view('templates/footer');
			return;
		}
		
		$config['upload_path'] = './uploads/'; 
		$config['allowed_types'] = 'html|zip';
		$config['overwrite'] = TRUE;

		$this->load->library('upload', $config);
		if (!$this->upload->do_upload('slide'))
		{
			$this->load->view('templates/header', $data);
			$this->load->view('exams/add_question', $data);
			$this->load->view('templates/footer');
			return;
		}

		if ($question['id'] === '')
		{
			// create question
			$insert_id = $this->questions_model->set_questions($question);
			$question['id'] = $insert_id;
		}
		else
		{
			// edit question
			$this->questions_model->update_questions($question);
		}
		
		redirect('exams/detail/'.$question['tid']);
	}
}