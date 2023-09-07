<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Poll extends CI_Controller
{

    public function index()
    {
        redirect('Poll/create');
    }

    public function view($id = NULL)
    {
        $this->load->helper(array('form'));
        $this->load->library('form_validation');

        if ($id === NULL) {
            redirect('Poll/create');
            return;
        }

        $this->load->library('Poll_model');

        $poll = $this->poll_model->get($id);

        if ($poll === false) {
            http_response_code(404);
            $this->load->view('errors/html/error_404');
            return;
        }

        $this->form_validation->set_rules('option[]', 'Option', 'numeric');
        $this->form_validation->set_rules('name', 'Name', 'required|max_length[30]');
        $this->form_validation->set_rules('firstname', 'Firstname', 'required|max_length[30]');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('poll/view', array('poll' => $poll));
            return;
        }

        $this->load->library('Option_manager');
        $this->load->library('Entry_manager');
        $this->load->library('Entry_model');

        $options = $this->option_manager->getfromPoll($poll['id']);

        $available = array_filter($options, function ($option) {
            return in_array($option->getid(), $this->input->post('option') ?? []);
        });


        $unavailable = array_filter($options, function ($option) {
            return !in_array($option->getid(), $this->input->post('option') ?? []);
        });

        foreach ($available as $option) {
            $result = $this->entry_manager->create(
                new Entry_model(
                    null,
                    $option->getid(),
                    $this->input->post('name'),
                    $this->input->post('firstname'),
                    true
                )
            );

            if (!$result) {
                $this->load->view('poll/view', array('poll' => $poll, 'error' => "Error while saving your anwser."));
                return;
            }
        }

        foreach ($unavailable as $option) {
            $result = $this->entry_manager->create(
                new Entry_model(
                    null,
                    $option->getid(),
                    $this->input->post('name'),
                    $this->input->post('firstname'),
                    false
                )
            );
            if (!$result) {
                $this->load->view('poll/view', array('poll' => $poll, 'error' => "Error while saving your anwser."));
                return;
            }
        }

        redirect('Poll/success');
    }

    public function create()
    {
        if (!$this->session->userdata('id')) {
            redirect('Connexion');
            return;
        }

        $this->load->helper(array('form'));
        $this->load->library('form_validation');

        $datestart = isset($_POST['datestart']) ? $_POST['datestart'] : [];
        $dateend = isset($_POST['dateend']) ? $_POST['dateend'] : [];

        $this->form_validation->set_rules('title', 'Title', 'required|max_length[50]');
        $this->form_validation->set_rules('location', 'Location', 'max_length[40]');
        $this->form_validation->set_rules('description', 'Description', 'max_length[500]');
        $this->form_validation->set_rules('datestart[]', 'Date start', 'required|callback_date_check');
        $this->form_validation->set_rules('dateend[]', 'Date end', 'required|callback_date_check');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('poll/create');
            return;
        }

        if (count($datestart) != count($dateend)) {
            $this->load->view('poll/create', ['error' => 'Error while creating the poll.']);
            return;
        }

        if ($datestart === []) {
            $this->load->view('poll/create', ['error' => 'You must have atleast one date, you lonely person.']);
            return;
        }

        $this->load->library('Poll_model');

        $options = [];
        for ($i = 0; $i < count($datestart); $i++)
            $options[] = ['start' => $datestart[$i], 'end' => $dateend[$i]];

        $poll = $this->poll_model->create(
            $this->input->post('title'),
            $this->input->post('description'),
            $this->input->post('location'),
            $options
        );

        if ($poll) {
            redirect('Poll/view/' . $poll);
        } else {
            $this->load->view('poll/create', ['error' => 'Error while creating the poll.']);
        }
    }

    public function date_check($str)
    {
        if ($str === '' || $str === NULL) {
            $this->form_validation->set_message('date_check', 'The {field} field is required.');
            return FALSE;
        }

        return preg_match('/^(000[1-9]|00[1-9]\d|0[1-9]\d\d|100\d|10[1-9]\d|1[1-9]\d{2}|[2-9]\d{3}|[1-9]\d{4}|1\d{5}|2[0-6]\d{4}|27[0-4]\d{3}|275[0-6]\d{2}|2757[0-5]\d|275760)-(0[1-9]|1[012])-(0[1-9]|[12]\d|3[01])T(0\d|1\d|2[0-4]):(0\d|[1-5]\d)(?::(0\d|[1-5]\d))?(?:.(00\d|0[1-9]\d|[1-9]\d{2}))?$/', $str);
    }

    public function close($id = NULL)
    {
        if ($id === NULL) {
            redirect('Poll/create');
            return;
        }

        $this->load->library('Poll_model');

        $result = $this->poll_model->close($id);

        $this->load->view('poll/close', array('result' => $result, 'id' => $id));
    }

    public function success()
    {
        $this->load->view('poll/success');
    }

    public function answers($id = NULL)
    {
        if ($id === NULL) {
            redirect('Poll/create');
            return;
        }

        $this->load->library('Poll_model');
        $this->load->library('Option_manager');
        $this->load->library('Entry_manager');

        $poll = $this->poll_model->get($id);

        if ($poll === false || $poll['owner'] != $this->session->userdata('id')) {
            http_response_code(404);
            $this->load->view('errors/html/error_404');
            return;
        }

        $options = $this->option_manager->getfromPoll($poll['id']);

        $entries_list = [];

        foreach ($options as $option) {
            $entries_list[] = $this->entry_manager->getfromOption($option->getid());
        }
        $entries_listinv = [];

        $options_ok = [];
        $options_ok_max = 0;
        for ($i = 0; $i < count($options); $i++) {
            $options_ok[$options[$i]->getid()] = 0;
            foreach ($entries_list[$i] as $entry) {
                if ($entry->getavailable()) {
                    $options_ok[$options[$i]->getid()]++;
                }
            }
            if ($options_ok[$options[$i]->getid()] > $options_ok_max) {
                $options_ok_max = $options_ok[$options[$i]->getid()];
            }
        }

        foreach ($entries_list as $entries) {
            foreach ($entries as $entry) {
                $entries_listinv[$entry->getfirstname() . $entry->getname()][] = $entry;
            }
        }



        $this->load->view('poll/answers', array('poll' => $poll, 'options' => $options, 'entries_list' => $entries_listinv, 'options_ok' => $options_ok, 'options_ok_max' => $options_ok_max));
    }
}