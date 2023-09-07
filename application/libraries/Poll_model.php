<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Poll_model
{

    private $CI;

    public function __construct()
    {
        $this->CI = &get_instance();
        $this->CI->load->database();
    }

    public function create($title, $description, $location, $options)
    {
        $this->CI->load->helper('string');
        $id = random_string('alnum', 50);

        $result = $this->CI->db->insert(
            'poll',
            array(
                'id' => $id,
                'title' => $title,
                'description' => $description,
                'location' => $location,
                'owner' => $this->CI->session->userdata('id')
            )
        );

        if ($result) {
            foreach ($options as $option) {
                $this->CI->db->insert(
                    'option',
                    array(
                        'poll' => $id,
                        'start' => date("Y-m-d\TH:i:s", strtotime($option['start'])),
                        'end' => date("Y-m-d\TH:i:s", strtotime($option['end']))
                    )
                );
            }

            return $id;
        }

        return false;
    }

    public function list()
    {
        $query = $this->CI->db->select("id, title, description, location")
            ->where("owner", $this->CI->session->userdata('id'))
            ->order_by("date", "desc")
            ->get("poll");

        if ($query->num_rows() == 0)
            return [];

        $data = $query->result();

        $polls = array();

        foreach ($data as $poll) {
            $polls[] = array(
                'id' => $poll->id,
                'title' => $poll->title,
                'description' => $poll->description,
                'location' => $poll->location
            );
        }

        if (count($polls) == 0)
            return array();

        return $polls;
    }

    public function get($id)
    {
        $query = $this->CI->db->select("title, description, location, owner, active")
            ->where("id", $id)
            ->get("poll");

        if ($query->num_rows() == 0)
            return false;

        $data = $query->row();

        $poll = array(
            'id' => $id,
            'title' => $data->title,
            'description' => $data->description,
            'location' => $data->location,
            'owner' => $data->owner,
            'active' => (bool) $data->active
        );

        $this->CI->load->library('Option_manager');

        $poll['options'] = $this->CI->option_manager->getfromPoll($id);

        return $poll;
    }

    public function close($id)
    {
        if (!$this->CI->session->userdata('id'))
            return false;

        $query = $this->CI->db->select("owner")
            ->where("id", $id)
            ->get("poll");

        if ($query->num_rows() == 0)
            return false;

        if ($query->row()->owner != $this->CI->session->userdata('id'))
            return false;

        $this->CI->db->where('id', $id)
            ->update('poll', array('active' => false));

        return true;
    }
}