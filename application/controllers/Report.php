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
    
    public function buktiPenyetoran(){
        
        $data['title'] = 'Bukti Penyetoran';
        $data['contentView'] = 'report/buktiPenyetoran';
        
        $data['tarif'] = $this->Master_model->rate();
        $data['produksi'] = $this->Entry_model->produksi();
        $data['lintasan'] = $this->Master_model->lintasan();
        $data['pelabuhan'] = $this->Master_model->pelabuhan();
        $data['kapal'] = $this->Master_model->kapal_spv();
        $data['tarif'] = $this->Master_model->tarif();
        $data['report'] = array(
            'kapalReport' => $this->input->post('nama_kapal'),
            'tripReport' => $this->input->post('trip'),
            'pelabuhanReport' => $this->input->post('pelabuhan_asal'),
            'lintasanReport' => $this->input->post('lintasan'),
            'tanggalAwalReport' => $this->input->post('tanggal_awal'),
            'tanggalAkhirReport' => $this->input->post('tanggal_akhir'),
        );



        $this->load->view('template/dashboard/body', $data);
        // redirect(index);
    }
    
}