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
        $data['archive_list'] = $this->Archive_model->index();


        $this->load->view('template/dashboard/body', $data);
        // $this->load->view('pages/dashboard', $data);
    }
}