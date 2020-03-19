<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Privacy extends MY_Controller
{

    public function index()
    {
        $this->show_view(['privacy/'.$this->_view_prefix.'top']);
    }

}