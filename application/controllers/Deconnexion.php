<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Deconnexion extends CI_Controller
{
    public function index() {
        $this->session->sess_destroy();
        redirect();
    }
}