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
        
        $data['tarif'] = $this->Master_model->rate();
        $data['produksi'] = $this->Entry_model->produksi();
        $data['lintasan'] = $this->Master_model->lintasan();
        $data['pelabuhan'] = $this->Master_model->pelabuhan();
        $data['kapal'] = $this->Master_model->kapal_spv();
        $data['tarif'] = $this->Master_model->tarif();
        $this->load->view('template/dashboard/body', $data);
    }
}