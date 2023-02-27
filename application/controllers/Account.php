<?php

class Account extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('User_model');
    }
    public function index()
    {
        $data['title'] = 'Account';
        $data['contentView'] = 'pages/';

        $this->load->view('template/dashboard/body', $data);
        // $this->load->view('pages/dashboard', $data);
    }

}