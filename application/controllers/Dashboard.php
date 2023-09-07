<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
	public function index()
	{
		if (!$this->session->userdata('id')) {
			redirect('Connexion');
			return;
		}

		$this->load->database();

		$this->load->library('Poll_model');

		$polls = $this->poll_model->list();

		$this->load->view('dashboard', array('polls' => $polls));
    }
}