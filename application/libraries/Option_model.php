<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Option_model
{
    private $id = null;

    private $start = null;

    private $end = null;

    private $entries = null;

    public function __construct($id = null, $start = null, $end = null)
    {
        $this->id = $id;
        $this->start = $start;
        $this->end = $end;
    }

    public function getid()
    {
        return $this->id;
    }

    public function getstart()
    {
        return $this->start;
    }

    public function getend()
    {
        return $this->end;
    }
}