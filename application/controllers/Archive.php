<?php

class Archive extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('tgl_indo');
    }
    public function index()
    {
        $data['title'] = 'Archive';
        $data['contentView'] = 'archive/index';
        $data['pendapatan'] = $this->Income_model->pendapatan();


        $this->load->view('template/dashboard/body', $data);
        // $this->load->view('pages/dashboard', $data);
    }
}