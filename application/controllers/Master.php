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
        $data['pelabuhan'] = $this->Master_model->semuaPelabuhan();
        $this->load->view('template/dashboard/body', $data);
        // $this->load->view('pages/dashboard', $data);
    }

    public function editDataPelabuhan(){
        $data['title'] = 'Edit Pelabuhan';
        $data['contentView'] = 'pages/master/edit/editPelabuhan';
        $data['pelabuhan'] = $this->Master_model->pelabuhan();
        $data['editDataPelabuhan'] = $this->Master_model->editDataPelabuhan($_GET['id']);
        $this->load->view('template/dashboard/body', $data);
    }

    public function prosesEditPelabuhan(){
        
        $dataInput = [
            'name' => $this->input->post('nama_pelabuhan'),
            'code' => $this->input->post('code_pelabuhan'),
            'timezone' => $this->input->post('timezone_pelabuhan'),
        ];
        $this->Master_model->editPelabuhan($dataInput, $_GET['id']);
        redirect('dashboard/master/pelabuhan');
    }

    public function tambahPelabuhan()
    {
        $data['title'] = 'Tambah Pelabuhan';
        $data['contentView'] = "pages/master/tambah/tambahPelabuhan";
        
        $this->load->view('template/dashboard/body', $data);
    }
    
    public function prosesTambahPelabuhan()
    {
        $data['idHighest'] = 0;
        $id = '';
        foreach($this->Master_model->harbourAll() as $key => $value){
            
            if($data['idHighest'] < substr($value['id_harbours'], strlen($value['id_harbours'])-2,strlen($value['id_harbours']))){
                $data['idHighest'] = intval(substr($value['id_harbours'], strlen($value['id_harbours'])-2,strlen($value['id_harbours'])));
            }
        }
        if(strlen($data['idHighest']+1) == 1){
            $id = substr($value['id_harbours'], 0,strlen($value['id_harbours'])-1).$data['idHighest'] + 1;
        } else {
            $id = substr($value['id_harbours'], 0,2).$data['idHighest'] + 1;
        }
        
        $dataInput = [
            'id_harbours' => $id,
            'harbour' => $this->input->post('pelabuhan'),
            'name' => $this->input->post('nama_pelabuhan'),
            'code' => $this->input->post('code_pelabuhan'),
            'timezone' => $this->input->post('timezone_pelabuhan'),
        ];
        $this->Master_model->tambahPelabuhan($dataInput);
        redirect('dashboard/master/pelabuhan');
    }


    public function lintasan()
    {
        $data['title'] = 'Lintasan';
        $data['contentView'] = "pages/master/lintasan";
        $data['semuaLintasan'] = $this->Master_model->semuaLintasan();

        $this->load->view('template/dashboard/body', $data);
        // $this->load->view('pages/dashboard', $data);
    }
    public function editDataLintasan(){
        $data['title'] = 'Edit Lintasan';
        $data['contentView'] = 'pages/master/edit/editLintasan';
        $data['lintasan'] = $this->Master_model->semuaLintasan();
        $data['editDataLintasan'] = $this->Master_model->editDataLintasan($_GET['id']);
        $this->load->view('template/dashboard/body', $data);
    }

    public function prosesEditLintasan(){
        
        $dataInput = [
            'segment' => $this->input->post('segmen'),
            'distance' => $this->input->post('jarak'),
            'travel_time' => $this->input->post('waktu_tempuh'),
        ];
        $this->Master_model->editLintasan($dataInput, $_GET['id']);
        redirect('dashboard/master/lintasan');
    }

    public function tambahLintasan()
    {
        $data['title'] = 'Tambah Lintasan';
        $data['contentView'] = "pages/master/tambah/tambahLintasan";
        $data['pelabuhan'] = $this->Master_model->harbourAll();
        
        $this->load->view('template/dashboard/body', $data);
    }
    
    public function prosesTambahLintasan()
    {
        $origin = '';
        $destination = '';

        foreach($this->Master_model->harbourAll() as $row){
            if($row['id_harbours'] ==  $this->input->post('origin')){
                $origin = $row['pelabuhan'];
            }
            if($row['id_harbours'] ==  $this->input->post('destination')){
                $destination = $row['pelabuhan'];
            }
        }

        $route = $origin."-".$destination;
        
        $dataInput = [
            'route' => $route,
            'origin'   => $this->input->post('origin'), 
            'destination'   => $this->input->post('destination'), 
            'segment'   => $this->input->post('segmen'),
            'distance'   => $this->input->post('jarak'),
            'travel_time'   => $this->input->post('waktu_tempuh'),
            
        ];
        $this->Master_model->tambahLintasan($dataInput);
        redirect('dashboard/master/lintasan');
    }

    public function kapal()
    {
        $data['title'] = 'Kapal';
        $data['contentView'] = "pages/master/kapal";
        $data['kapal'] = $this->Master_model->kapal();

        $this->load->view('template/dashboard/body', $data);
        // echo "DAta akan disimpan disini";
    }
    public function editDataKapal(){
        $data['title'] = 'Edit Kapal';
        $data['contentView'] = 'pages/master/edit/editKapal';
        $data['kapal'] = $this->Master_model->kapal();
        $data['editDataKapal'] = $this->Master_model->editDataKapal($_GET['id']);
        $this->load->view('template/dashboard/body', $data);
    }

    public function prosesEditKapal(){
        
        $dataInput = [
            'code'   => $this->input->post('code'), 
            'company'   => $this->input->post('company'),
            'grt'   => $this->input->post('grt'),
            'type'   => $this->input->post('type'),
            'register_num'   => $this->input->post('register_num'),
            'imo_num'   => $this->input->post('imo_num'),
            'id_card'   => $this->input->post('id_card'),
            'mmsi'   => $this->input->post('mmsi'),
            'length_over_all'   => $this->input->post('length_over_all'),
            'breadth'   => $this->input->post('breadth'),
            'draft'   => $this->input->post('draft'),
            'gt'   => $this->input->post('gt'),
            'build_year'   => $this->input->post('build_year'),
            'shipyard'   => $this->input->post('shipyard'),
            'registration_port'   => $this->input->post('registration_port'),
            'anchor_weight'   => $this->input->post('anchor'),
        ];
        $this->Master_model->editKapal($dataInput, $_GET['id']);
        redirect('dashboard/master/kapal');
    }

    public function tambahKapal()
    {
        $data['title'] = 'Tambah Kapal';
        $data['contentView'] = "pages/master/tambah/tambahKapal";
        $data['kapal'] = $this->Master_model->kapal();
        
        $this->load->view('template/dashboard/body', $data);
    }
    
    public function prosesTambahKapal()
    {
        $data['idHighest'] = 0;
        $id = '';
        foreach($this->Master_model->kapal() as $key => $value){
            
            if($data['idHighest'] < substr($value['id'], strlen($value['id'])-2,strlen($value['id']))){
                $data['idHighest'] = intval(substr($value['id'], strlen($value['id'])-2,strlen($value['id'])));
            }
        }

        if(strlen($data['idHighest']+1) == 1){
            $id = substr($value['id'], 0,strlen($value['id'])-1).$data['idHighest'] + 1;
        } else {
            $id = substr($value['id'], 0,2).$data['idHighest'] + 1;
        }

        $dataInput = [
            'id' => $id,
            'ferry'   => $this->input->post('ferry'), 
            'code'   => $this->input->post('code'), 
            'company'   => $this->input->post('company'),
            'grt'   => $this->input->post('grt'),
            'type'   => $this->input->post('type'),
            'register_num'   => $this->input->post('register_num'),
            'imo_num'   => $this->input->post('imo_num'),
            'id_card'   => $this->input->post('id_card'),
            'mmsi'   => $this->input->post('mmsi'),
            'length_over_all'   => $this->input->post('length_over_all'),
            'breadth'   => $this->input->post('breadth'),
            'draft'   => $this->input->post('draft'),
            'gt'   => $this->input->post('gt'),
            'build_year'   => $this->input->post('build_year'),
            'shipyard'   => $this->input->post('shipyard'),
            'registration_port'   => $this->input->post('registration_port'),
            'anchor_weight'   => $this->input->post('anchor'),
        ];
        $this->Master_model->tambahKapal($dataInput);
        redirect('dashboard/master/kapal');
    }

    public function tarif()
    {
        $data['title'] = 'Tarif';
        $data['contentView'] = "pages/master/tarif";
        $data['tarif'] = $this->Master_model->rate();

        $this->load->view('template/dashboard/body', $data);
        // echo "DAta akan disimpan disini";
    }

    public function editDataTarif(){
        $data['title'] = 'Edit Tarif';
        $data['contentView'] = 'pages/master/edit/editTarif';
        $data['produksi'] = $this->Entry_model->produksi();
        $data['lintasan'] = $this->Master_model->lintasan();
        $data['pelabuhan'] = $this->Master_model->pelabuhan();
        $data['kapal'] = $this->Master_model->kapal();
        $data['kapal_spv'] = $this->Master_model->kapal_spv();
        $data['tarif'] = $this->Master_model->tarif();
        $data['trip'] = $this->Entry_model->trip();
        $data['editDataTarif'] = $this->Master_model->editDataTarif($_GET['id']);
        $this->load->view('template/dashboard/body', $data);
    }

    public function prosesEditTarif(){
        $data['lintasan'] = $this->Master_model->lintasanWIthId($this->input->post('lintasan'));
        $tahun = substr($this->input->post('edit_tanggal_berlaku'),2,-6);
        $bulan = substr($this->input->post('edit_tanggal_berlaku'),5,-3);
        foreach($data['lintasan'] as $key => $value){
            $namaLintasan = str_replace(' ', '',ucwords(str_replace('-', ' ', strtolower($value['lintasan']))));
        }
                        
        $valueTarif = $namaLintasan.$bulan.$tahun;
        $dataInput = [
            'start_date' => $this->input->post('edit_tanggal_berlaku'),
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
        $this->Master_model->editTarif($dataInput, $_GET['id']);
        redirect('dashboard/master/tarif');
    }

    public function tambahTarif()
    {
        $data['title'] = 'Tambah Tarif';
        $data['contentView'] = "pages/master/tambah/tambahTarif";
        $data['tarif'] = $this->Master_model->rate();
        $data['produksi'] = $this->Entry_model->produksi();
        $data['lintasan'] = $this->Master_model->lintasan();
        $data['pelabuhan'] = $this->Master_model->pelabuhan();
        $data['kapal'] = $this->Master_model->kapal();
        $data['tarif'] = $this->Master_model->tarif();

        $this->load->view('template/dashboard/body', $data);
    }

    public function prosesTambahTarif()
    {
        $data['lintasan'] = $this->Master_model->lintasanWIthId($this->input->post('lintasan'));
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
        $this->Master_model->tambahTarif($dataInput);
        redirect('dashboard/master/tarif');
    }

    public function deleteTarif(){
        $this->Master_model->deleteTarif($_GET['id']);
        redirect('dashboard/master/tarif');
    }
    public function deletePelabuhan(){
        $this->Master_model->deletePelabuhan($_GET['id']);
        redirect('dashboard/master/pelabuhan');
    }
    public function deleteLintasan(){
        $this->Master_model->deleteLintasan($_GET['id']);
        redirect('dashboard/master/lintasan');
    }
    public function deleteKapal(){
        $this->Master_model->deleteKapal($_GET['id']);
        redirect('dashboard/master/kapal');
    }
}