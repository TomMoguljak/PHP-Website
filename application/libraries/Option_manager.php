<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Option_manager
{
    private $CI;

    public function __construct()
    {
        $this->CI = &get_instance();
        $this->CI->load->database();
    }

    public function getfromPoll($pollid)
    {
        $this->CI->load->library("Option_model");

        $query = $this->CI->db->select("id, start, end")
            ->where("poll", $pollid)
            ->get("option");

        if ($query->num_rows() == 0)
            return [];

        $data = $query->result();

        $options = array();

        foreach ($data as $option) {
            $options[] = new Option_model(
                $option->id,
                $option->start,
                $option->end
            );
        }

        return $options;
    }

    public function get($optionid)
    {
        $this->CI->load->library("Option_model");

        $query = $this->CI->db->select("id, start, end")
            ->where("id", $optionid)
            ->get("option");

        if ($query->num_rows() == 0)
            return false;

        $data = $query->result();

        $option = new Option_model(
            $data[0]->id,
            $data[0]->start,
            $data[0]->end
        );

        return $option;
    }

    public function getentries($option)
    {
        $query = $this->CI->db->select("id, name, firstname, available")
            ->where("option", $option->getid())
            ->get("entry");

        if ($query->num_rows() == 0)
            return false;

        $data = $query->result();

        $entries = array();

        foreach ($data as $entry) {
            $entries[] = new Entry_model(
                $entry->id,
                $entry->name,
                $entry->firstname,
                $entry->available
            );
        }

        return $entries;
    }
}