<?php

class Master extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('User_model');
    }
    public function pelabuhan()
    {
        $data['title'] = 'Pelabuhan';
        $data['contentView'] = "pages/master/pelabuhan";
        $data['pelabuhan'] = $this->Entry_model->semuaPelabuhan();
        $this->load->view('template/dashboard/body', $data);
        // $this->load->view('pages/dashboard', $data);
    }
    public function lintasan()
    {
        $data['title'] = 'Lintasan';
        $data['contentView'] = "pages/master/lintasan";
        $data['semuaLintasan'] = $this->Entry_model->semuaLintasan();

        $this->load->view('template/dashboard/body', $data);
        // $this->load->view('pages/dashboard', $data);
    }

    public function kapal()
    {
        $data['title'] = 'Kapal';
        $data['contentView'] = "pages/master/kapal";
        $data['kapal'] = $this->Entry_model->kapal();

        $this->load->view('template/dashboard/body', $data);
        // echo "DAta akan disimpan disini";
    }

    public function tarif()
    {
        $data['title'] = 'Tarif';
        $data['contentView'] = "pages/master/tarif";
        $data['tarif'] = $this->Entry_model->rate();

        $this->load->view('template/dashboard/body', $data);
        // echo "DAta akan disimpan disini";
    }
    public function tambahTarif()
    {
        $data['title'] = 'Tambah Tarif';
        $data['contentView'] = "pages/master/tambahTarif";
        $data['tarif'] = $this->Entry_model->rate();
        $data['produksi'] = $this->Entry_model->produksi();
        $data['lintasan'] = $this->Entry_model->lintasan();
        $data['pelabuhan'] = $this->Entry_model->pelabuhan();
        $data['kapal'] = $this->Entry_model->kapal();
        $data['tarif'] = $this->Entry_model->tarif();

        $this->load->view('template/dashboard/body', $data);
    }

    public function prosesTambahTarif()
    {
        $data['lintasan'] = $this->Entry_model->lintasanWIthId($this->input->post('lintasan'));
        $tahun = substr($this->input->post('tanggal_berlaku'),2,-6);
        $bulan = substr($this->input->post('tanggal_berlaku'),5,-3);
        foreach($data['lintasan'] as $key => $value){
            $namaLintasan = str_replace(' ', '',ucwords(str_replace('-', ' ', strtolower($value['lintasan']))));
        }
                        
        $valueTarif = $namaLintasan.$bulan.$tahun;
        $dataInput = [
            'start_date' => $this->input->post('tanggal_berlaku'),
            // 'rate_type' => $this->input->post('jenis_tarif'),
            'rate_type' => $valueTarif,
            'id_route' => $this->input->post('lintasan'),
            'Gol1' => $this->input->post('Gol1'),
            'Gol2' => $this->input->post('Gol2'),
            'Gol3' => $this->input->post('Gol3'),
            'Gol4Pen' => $this->input->post('Gol4Pen'),
            'Gol4Bar' => $this->input->post('Gol4Bar'),
            'Gol5Pen' => $this->input->post('Gol5Pen'),
            'Gol5Bar' => $this->input->post('Gol5Bar'),
            'Gol6Pen' => $this->input->post('Gol6Pen'),
            'Gol6Bar' => $this->input->post('Gol6Bar'),
            'Gol7' => $this->input->post('Gol7'),
            'Gol8' => $this->input->post('Gol8'),
            'Gol9' => $this->input->post('Gol9'),
            'DewasaEksekutif' => $this->input->post('DewasaEksekutif'),
            'BayiEksekutif' => $this->input->post('BayiEksekutif'),
            'DewasaBisnis' => $this->input->post('DewasaBisnis'),
            'BayiBisnis' => $this->input->post('BayiBisnis'),
            'DewasaEkonomi' => $this->input->post('DewasaEkonomi'),
            'BayiEkonomi' => $this->input->post('BayiEkonomi'),
            'Suplesi1Dewasa' => $this->input->post('Suplesi1Dewasa'),
            'Suplesi1Anak' => $this->input->post('Suplesi1Anak'),
            'Suplesi2Dewasa' => $this->input->post('Suplesi2Dewasa'),
            'Suplesi2Anak' => $this->input->post('Suplesi2Anak'),
            'Hewan' => $this->input->post('Hewan'),
            'Gayor' => $this->input->post('Gayor'),
            'Carter' => $this->input->post('Carter'),
            'BarangVolume' => $this->input->post('barang_volume'),
            'BarCur' => $this->input->post('barang_pendapatan'),
            'Gol1TJP' => $this->input->post('Gol1TJP'),
            'Gol2TJP' => $this->input->post('Gol2TJP'),
            'Gol3TJP' => $this->input->post('Gol3TJP'),
            'Gol4PenTJP' => $this->input->post('Gol4PenTJP'),
            'Gol4BarTJP' => $this->input->post('Gol4BarTJP'),
            'Gol5PenTJP' => $this->input->post('Gol5PenTJP'),
            'Gol5BarTJP' => $this->input->post('Gol5BarTJP'),
            'Gol6PenTJP' => $this->input->post('Gol6PenTJP'),
            'Gol6BarTJP' => $this->input->post('Gol6BarTJP'),
            'Gol7TJP' => $this->input->post('Gol7TJP'),
            'Gol8TJP' => $this->input->post('Gol8TJP'),
            'Gol9TJP' => $this->input->post('Gol9TJP'),
            'DewasaEksekutifTJP' => $this->input->post('DewasaEksekutifTJP'),
            'BayiEksekutifTJP' => $this->input->post('BayiEksekutifTJP'),
            'DewasaBisnisTJP' => $this->input->post('DewasaBisnisTJP'),
            'BayiBisnisTJP' => $this->input->post('BayiBisnisTJP'),
            'DewasaEkonomiTJP' => $this->input->post('DewasaEkonomiTJP'),
            'BayiEkonomiTJP' => $this->input->post('BayiEkonomiTJP'),
            'Gol1IW' => $this->input->post('Gol1IW'),
            'Gol2IW' => $this->input->post('Gol2IW'),
            'Gol3IW' => $this->input->post('Gol3IW'),
            'Gol4PenIW' => $this->input->post('Gol4PenIW'),
            'Gol4BarIW' => $this->input->post('Gol4BarIW'),
            'Gol5PenIW' => $this->input->post('Gol5PenIW'),
            'Gol5BarIW' => $this->input->post('Gol5BarIW'),
            'Gol6PenIW' => $this->input->post('Gol6PenIW'),
            'Gol6BarIW' => $this->input->post('Gol6BarIW'),
            'Gol7IW' => $this->input->post('Gol7IW'),
            'Gol8IW' => $this->input->post('Gol8IW'),
            'Gol9IW' => $this->input->post('Gol9IW'),
            'DewasaEksekutifIW' => $this->input->post('DewasaEksekutifIW'),
            'BayiEksekutifIW' => $this->input->post('BayiEksekutifIW'),
            'DewasaBisnisIW' => $this->input->post('DewasaBisnisIW'),
            'BayiBisnisIW' => $this->input->post('BayiBisnisIW'),
            'DewasaEkonomiIW' => $this->input->post('DewasaEkonomiIW'),
            'BayiEkonomiIW' => $this->input->post('BayiEkonomiIW'),
        ];
        $this->User_model->tambahTarif($dataInput);
        redirect('dashboard/master/tarif');
    }



}