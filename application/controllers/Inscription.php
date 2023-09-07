<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Inscription extends CI_Controller
{
	public function index()
	{
		if ($this->session->userdata('id')) {
			redirect('Accueil');
			return;
		}
		
		$this->load->helper(array('form'));
		$this->load->library('form_validation');

		$this->load->database();

		$this->form_validation->set_rules('name', 'Name', 'required|max_length[30]');
		$this->form_validation->set_rules('firstname', 'Firstname', 'required|max_length[30]');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[user.email]|max_length[40]');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[4]');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('inscription');
			return;
		}

		$this->load->library('User');

		$user = $this->user->create(
			$this->input->post('name'),
			$this->input->post('firstname'),
			$this->input->post('email'),
			$this->input->post('password')
		);

		if ($user) {
			$this->session->set_userdata($user);
			redirect('Accueil');
		} else {
			echo "Error";
		}
	}
}