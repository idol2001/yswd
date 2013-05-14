<?php
class Api extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('exams_model');
		$this->load->model('questions_model');
// 		$this->output->enable_profiler(TRUE);
	}
	
	private function audio_url($id, $audio_file)
	{
		$dir = $this->config->item('exam_dir');
		return base_url().$dir.'/'.$id.'/'.$audio_file;
	}
	
	public function get_questions($tid = FALSE)
	{
		if ($tid === FALSE)
		{
			$this->output->set_status_header('500');
		}
		else
		{
			$data['exam'] = $this->exams_model->get_exams($tid);
			$data['exam']['audio_url'] = $this->audio_url($data['exam']['id'], $data['exam']['audio_file']);
			$data['title'] = $data['exam']['title'];
			$data['questions'] = $this->questions_model->get_questions_by_exam_id($tid);
			$this->load->view('api/get_questions', $data);
		}
	}
}
?>