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

    public function addArchive(){
        $data = [
        'document_name' => $this->input->post("document_name"),
        'document_type' => $this->input->post("document_type"),
        'archive' => $this->input->post("archive"),
        ];
        $this->Archive_model->tambahArchive($data);
        redirect('archive');

    }
    
    public function deleteArchive()
    {
        $this->Archive_model->deleteArchive($_GET['id']);
        redirect('archive');
    }
}