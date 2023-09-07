<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Entry_model
{
    private $id = null;

    private $option = null;

    private $name = null;

    private $firstname = null;

    private $available = null;

    public function __construct($id = null, $option = null, $name = null, $firstname = null, $available = null)
    {
        $this->id = $id;
        $this->option = $option;
        $this->name = $name;
        $this->firstname = $firstname;
        $this->available = $available;
    }

    public function getid()
    {
        return $this->id;
    }

    public function getoption()
    {
        return $this->option;
    }

    public function getname()
    {
        return $this->name;
    }

    public function getfirstname()
    {
        return $this->firstname;
    }

    public function getavailable()
    {
        return $this->available;
    }
}