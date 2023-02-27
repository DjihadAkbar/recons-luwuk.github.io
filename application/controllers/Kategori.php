<?php

class Kategori extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('User_model');
    }
    public function index()
    {
        $data['title'] = 'Kategori';
        $data['contentView'] = "pages/kategori/form";

        $this->load->view('template/dashboard/body', $data);
        // $this->load->view('pages/dashboard', $data);
    }
    public function create()
    {
        $data['title'] = 'Kategori';
        $data['contentView'] = "pages/kategori/create";

        $this->load->view('template/dashboard/body', $data);
        // $this->load->view('pages/dashboard', $data);
    }

    public function store()
    {
        echo "DAta akan disimpan disini";
    }

}