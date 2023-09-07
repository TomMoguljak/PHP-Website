<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User
{
    private $CI;
    public function __construct()
    {
        $this->CI = &get_instance();
        $this->CI->load->database();
    }

    public function create($name, $firstname, $email, $password)
    {
        $result = $this->CI->db->insert(
            'user',
            array(
                'name' => $name,
                'firstname' => $firstname,
                'email' => strtolower($email),
                'password' => password_hash($password, PASSWORD_DEFAULT)
            )
        );

        if ($result) {
            return array(
                'id' => $this->CI->db->insert_id(),
                'name' => $name,
                'firstname' => $firstname,
                'email' => $email
            );
        } else {
            return false;
        }
    }

    public function login($email, $password)
    {
        $query = $this->CI->db->get_where(
            'user',
            array(
                'email' => $email
            )
        );

        if ($query->num_rows() == 0)
            return false;

        $data = $query->row();

        if (!password_verify($password, $data->password))
            return false;

        return array(
            'id' => $data->id,
            'name' => $data->name,
            'firstname' => $data->firstname,
            'email' => $data->email
        );
    }
}