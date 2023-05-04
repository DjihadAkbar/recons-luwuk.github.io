<?php

class machine extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('User_model');
    }
    public function index()
    {
        $data['title'] = 'Entry Data';

        $this->load->view('template/dashboard/body', $data);
    }

}