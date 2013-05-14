<?php
class Exams extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('exams_model');
		$this->load->model('questions_model');
		$this->output->enable_profiler(TRUE);
	}
	
	public function index()
	{
		$data['exams'] = $this->exams_model->get_exams();
		$data['title'] = '试题';
		
		$this->load->view('templates/header', $data);
		$this->load->view('exams/index', $data);
		$this->load->view('templates/footer');
	}
	
	private function audio_url($id, $audio_file)
	{
		$dir = $this->config->item('exam_dir');
		return base_url().$dir.'/'.$id.'/'.$audio_file;
	}
	
	private function audio_path($id, $audio_file)
	{
		$base_path = $this->config->item('base_path');
		$dir = $this->config->item('exam_dir');
		return $base_path.'/'.$dir.'/'.$id.'/'.$audio_file;
	}
	
	public function create()
	{
		$this->load->helper('form');
		$this->load->library('form_validation');
			
		$data['title'] = '新建考试';
		$data['type'] = array (
			'cet4' => 'CET-4',
			'cet6' => 'CET-6',
			'toefl' => 'TOEFL',
			'ielts' => 'IELTS'
		);
		
		$data['exam'] = array (
			'id' => '',
			'type' => '',
			'title' => '',
			'testdate' => '',
			'teacher' => '',
			'duration' => '',
			'audio_file' => '',
		);
		$this->load->view('templates/header', $data);
		$this->load->view('exams/edit', $data);
		$this->load->view('templates/footer');
	}
	
	public function edit($id = FALSE)
	{
		$this->load->helper('form');
		$this->load->library('form_validation');

		$data['title'] = '编辑考试';
		$data['type'] = array (
			'cet4' => 'CET-4',
			'cet6' => 'CET-6',
			'toefl' => 'TOEFL',
			'ielts' => 'IELTS'
		);
		
		$data['exam'] = $this->exams_model->get_exams($id);
		$data['exam']['audio_url'] = $this->audio_url($data['exam']['id'], $data['exam']['audio_file']);
		$this->load->view('templates/header', $data);
		$this->load->view('exams/edit', $data);
		$this->load->view('templates/footer');
	}
	
	public function save_exam()
	{
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		$data['title'] = '新建考试';
		$data['type'] = array (
			'cet4' => 'CET-4',
			'cet6' => 'CET-6',
			'toefl' => 'TOEFL',
			'ielts' => 'IELTS'
		);
		
		$exam = array (
			'id' => $this->input->post('id'),
			'type' => $this->input->post('type'),
			'title' => $this->input->post('title'),
			'testdate' => $this->input->post('testdate'),
			'teacher' => $this->input->post('teacher'),
			'duration' => $this->input->post('duration'),
			'audio_file' => $this->input->post('audio_file'),
		);
		$data['exam'] = $exam;
		
		$this->form_validation->set_rules('title', '名称', 'required');
// 		$this->form_validation->set_rules('password', '密码', 'required');
// 		$this->form_validation->set_rules('confirmpwd', '确认密码', 'required|matches[password]');
		
		if($this->form_validation->run() === FALSE)
		{
			$this->load->view('templates/header', $data);
			$this->load->view('exams/edit', $data);
			$this->load->view('templates/footer');
		}
		else
		{
			$config['upload_path'] = './uploads/'; 
			$config['allowed_types'] = '*';
			$config['overwrite'] = TRUE;

			$this->load->library('upload', $config);
			if (!$this->upload->do_upload('audio') && $exam['audio_file'] === '')
			{
				$data['error'] = $this->upload->display_errors();
				$this->load->view('templates/header', $data);
				$this->load->view('exams/edit', $data);
				$this->load->view('templates/footer');
			}
			else
			{
				$file = $this->upload->data();
				if ($file['file_name'] !== '')
				{
					$exam['audio_file'] = $file['file_name'];
				}

				if ($exam['id'] === '') 
				{
					date_default_timezone_set('PRC');
					$curTime = date('Y-m-d H:i:s');
					$exam['createtime'] = $curTime;
					$exam['createuser'] = 1;
					$insert_id = $this->exams_model->set_exams($exam);
					$this->load->library('file_util');
					$aim_path = $this->audio_path($insert_id, $exam['audio_file']);
					$this->file_util->moveFile($file['full_path'], $aim_path, TRUE);
				}
				else
				{
					$this->exams_model->update_exams($exam);
					$this->load->library('file_util');
					$aim_path = $this->audio_path($exam['id'], $exam['audio_file']);
					$this->file_util->moveFile($file['full_path'], $aim_path, TRUE);

				}
				redirect('exams');
// 				$this->load->view('users/success', $data);
			}
		}
	}
	
	public function delete($id = FALSE)
	{
		if ($id !== FALSE)
		{
			$this->exams_model->del_exams($id);
			$this->load->helper('file');
			delete_files($this->audio_path($id, ''));
		}
		redirect('exams');
	}
	
	public function detail($tid = FALSE)
	{
		if ($tid === FALSE)
		{
			redirect('exams');
		}
		else
		{
			$data['exam'] = $this->exams_model->get_exams($tid);
			$data['exam']['audio_url'] = $this->audio_url($data['exam']['id'], $data['exam']['audio_file']);
			$data['title'] = $data['exam']['title'];
			$data['questions'] = $this->questions_model->get_questions_by_exam_id($tid);
			$this->load->view('templates/header', $data);
			$this->load->view('exams/detail', $data);
			$this->load->view('templates/footer');
		}
		
	}
}
?>