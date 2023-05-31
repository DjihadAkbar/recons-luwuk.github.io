<?php

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('tgl_indo');
    }
    public function index()
    {
        $data['firstDate'] = $this->input->post('tanggalAwalDashboard');
        $data['lastDate'] = $this->input->post('tanggalAkhirDashboard');
        $data['month'] = $this->input->post('bulan_dashboard');
        $data['title'] = 'Dashboard';
        $data['contentView'] = 'pages/dashboard';
        $data['pendapatan'] = $this->Income_model->pendapatan();
        $data['incomePerRoute'] = $this->Income_model->incomePerRoute();
        $data['incomePerHarbour'] = $this->Income_model->incomePerHarbour();
        $data['incomePerShip'] = $this->Income_model->incomePerShip();
        $data['incomeDaily'] = $this->Income_model->incomeDaily();
        $data['incomeDailyPerShip'] = $this->Income_model->incomeDailyPerShip();
        $data['incomeDailyPerHarbour'] = $this->Income_model->incomeDailyPerHarbour();
        $data['totalDaily'] = $this->Income_model->totalDaily($data['firstDate'], $data['lastDate'], $data['month']);
        $data['totalDailyPerShip'] = $this->Income_model->totalDailyPerShip();
        $data['totalDailyPerHarbour'] = $this->Income_model->totalDailyPerHarbour();


        $this->load->view('template/dashboard/body', $data);
        // $this->load->view('pages/dashboard', $data);
    }

}