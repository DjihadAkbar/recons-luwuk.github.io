<?php

class Account extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
    }
    public function index()
    {
        $data['title'] = 'Account';
        $data['contentView'] = 'pages/account/account';
        $data['account'] = $this->User_model->account();

        $this->load->view('template/dashboard/body', $data);
        // $this->load->view('pages/dashboard', $data);
    }

}