<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Entry_manager
{

    private $CI;

    public function __construct()
    {
        $this->CI = &get_instance();
        $this->CI->load->database();
    }

    public function getfromOption($optionid)
    {
        $this->CI->load->library("Entry_model");

        $query = $this->CI->db->select("id, name, firstname, available")
            ->where("option", $optionid)
            ->get("entry");

        if ($query->num_rows() == 0)
            return [];

        $data = $query->result();

        $entries = array();
        foreach ($data as $entry) {
            $entries[] = new Entry_model(
                $entry->id,
                $optionid,
                $entry->name,
                $entry->firstname,
                (bool)$entry->available
            );
        }
        return $entries;
    }

    public function get($entryid)
    {
        $this->CI->load->library("Entry_model");

        $query = $this->CI->db->select("id, name, firstname, available")
            ->where("id", $entryid)
            ->get("entry");

        if ($query->num_rows() == 0)
            return false;

        $data = $query->result();

        $entry = new Entry_model(
            $data[0]->id,
            $data[0]->name,
            $data[0]->firstname,
            $data[0]->available
        );

        return $entry;
    }

    public function create($entry)
    {

        $result = $this->CI->db->insert(
            'entry',
            array(
                'name' => $entry->getname(),
                'firstname' => $entry->getfirstname(),
                'option' => $entry->getoption(),
                'available' => $entry->getavailable()
            )
        );

        if ($result) {
            return true;
        }

        return false;
    }
}