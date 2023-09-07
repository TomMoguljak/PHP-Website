<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Connexion extends CI_Controller
{
	public function index()
	{
		if ($this->session->userdata('id')) {
			redirect('Accueil');
			return;
		}
		
		$this->load->helper(array('form'));
		$this->load->library('form_validation');

		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[4]');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('connexion');
			return;
		}

		$this->load->library('User');

		$user = $this->user->login(
			$this->input->post('email'),
			$this->input->post('password')
		);

		if ($user) {
			$this->session->set_userdata($user);
			redirect('Accueil');
		} else {
			$this->load->view('connexion', ['error' => 'Email or password invalid']);
		}

	}
}