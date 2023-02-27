<?php

class Report extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
    }
    public function index()
    {
        $data['title'] = 'Export Report';
        $data['contentView'] = 'report/report';
        
        $data['tarif'] = $this->Entry_model->rate();
        $data['produksi'] = $this->Entry_model->produksi();
        $data['lintasan'] = $this->Entry_model->lintasan();
        $data['pelabuhan'] = $this->Entry_model->pelabuhan();
        $data['kapal'] = $this->Entry_model->kapal();
        $data['tarif'] = $this->Entry_model->tarif();
        $this->load->view('template/dashboard/body', $data);
    }
}