<?php

class Entry extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
    }
    public function index()
    {
        $data['title'] = 'Pendapatan Harian';
        $data['contentView'] = 'pages/entry/dailyForm';
        $data['entry_data'] = $this->Entry_model->entryData();
        $data['produksi'] = $this->Entry_model->produksi();
        $data['lintasan'] = $this->Entry_model->lintasan();
        $data['pelabuhan'] = $this->Entry_model->pelabuhan();
        $data['kapal'] = $this->Entry_model->kapal();
        $this->load->view('template/dashboard/body', $data);
    }

    public function editEntryData(){
        $data['title'] = 'Edit Data';
        $data['contentView'] = 'pages/entry/editEntryData';
        $data['produksi'] = $this->Entry_model->produksi();
        $data['lintasan'] = $this->Entry_model->lintasan();
        $data['pelabuhan'] = $this->Entry_model->pelabuhan();
        $data['kapal'] = $this->Entry_model->kapal();
        $data['kapal_spv'] = $this->Entry_model->kapal_spv();
        $data['tarif'] = $this->Entry_model->tarif();
        $data['trip'] = $this->Entry_model->trip();
        $data['editData'] = $this->Entry_model->editEntryData($_GET['id']);
        $this->load->view('template/dashboard/body', $data);
    }

    public function prosesEditEntryData(){
        $dataInput = [
            'date' => $this->input->post('tanggal_berangkat'),
            'time' => $this->input->post('waktu_berangkat'),
            'id_ferry' => $this->input->post('nama_kapal'),
            'rate_type' => $this->input->post('jenis_tarif'),
            // 'rate_type' => $jenisTarif,
            'id_route' => $this->input->post('lintasan'),
            'id_harbour' => $this->input->post('pelabuhan_asal'),
            'id_trip' => $this->input->post('trip'),
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
            'BarangPendapatan' => $this->input->post('barang_pendapatan'),
        ];
        $this->Entry_model->editData($dataInput, $_GET['id']);
        redirect('dashboard/entry');
    }

    public function entryData()
    {
        $data['title'] = 'Entry Data';
        $data['contentView'] = 'pages/entry/entry';
        $data['produksi'] = $this->Entry_model->produksi();
        $data['lintasan'] = $this->Entry_model->lintasan();
        $data['pelabuhan'] = $this->Entry_model->pelabuhan();
        $data['kapal'] = $this->Entry_model->kapal();
        $data['kapal_spv'] = $this->Entry_model->kapal_spv();
        $data['tarif'] = $this->Entry_model->tarif();
        
        $this->load->view('template/dashboard/body', $data);
    }
    public function deleteEntryData(){
        $this->Entry_model->deleteEntryData($_GET['id']);
        redirect('dashboard/entry');
    }
    public function prosesEntry()
    {

        $tahun = 0;
        $bulan = 0;
        $tarif = $this->Entry_model->tarif();
        $lintasan = $this->Entry_model->lintasanWIthId($this->input->post('lintasan'));
        foreach($lintasan as $key => $value){
            $namaLintasan = str_replace(' ', '',ucwords(str_replace('-', ' ', strtolower($value['lintasan']))));
        }
        $valueTarif = '';
        foreach ($tarif as $key => $value) {
            if(substr($value['tarif'], 0,strlen($value['tarif']) - 4 ) == $namaLintasan){
                if(substr($value['tarif'], -2) >= $tahun){
                    $tahun = substr($value['tarif'], -2);
                }
            }
        }
        foreach ($tarif as $key => $value) {
            if(substr($value['tarif'], 0,strlen($value['tarif']) - 4 ) == $namaLintasan){
                if($tahun == substr($value['tarif'], -2) && substr($value['tarif'],-4, -2) >= $bulan){
                    $valueTarif = $value['tarif'];
                }
            }
        }
        
        $dataInput = [
            'date' => $this->input->post('tanggal_berangkat'),
            'time' => $this->input->post('waktu_berangkat'),
            'id_ferry' => $this->input->post('nama_kapal'),
            'rate_type' => $valueTarif,
            'id_route' => $this->input->post('lintasan'),
            'id_harbour' => $this->input->post('pelabuhan_asal'),
            'id_trip' => $this->input->post('trip'),
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
            'BarangPendapatan' => $this->input->post('barang_pendapatan'),
        ];
        $this->User_model->entry($dataInput);
        redirect('dashboard/entry');
    }
}