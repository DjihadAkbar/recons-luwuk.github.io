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
            'date' => $this->input->post('edit_tanggal_berangkat'),
            'time' => $this->input->post('edit_waktu_berangkat'),
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
            'ANGKPOS' => $this->input->post('ANGKPOS'),
            'BBM' => $this->input->post('BBM'),
            'BARTON' => $this->input->post('BARTON'),
            'BarangVolume' => $this->input->post('barang_volume'),
            'BarangPendapatan' => $this->input->post('barang_pendapatan'),
            'Gol1Serial_start' => $this->input->post('Gol1Serial_start'),
            'Gol2Serial_start' => $this->input->post('Gol2Serial_start'),
            'Gol3Serial_start' => $this->input->post('Gol3Serial_start'),
            'Gol4PenSerial_start' => $this->input->post('Gol4PenSerial_start'),
            'Gol4BarSerial_start' => $this->input->post('Gol4BarSerial_start'),
            'Gol5PenSerial_start' => $this->input->post('Gol5PenSerial_start'),
            'Gol5BarSerial_start' => $this->input->post('Gol5BarSerial_start'),
            'Gol6PenSerial_start' => $this->input->post('Gol6PenSerial_start'),
            'Gol6BarSerial_start' => $this->input->post('Gol6BarSerial_start'),
            'Gol7Serial_start' => $this->input->post('Gol7Serial_start'),
            'Gol8Serial_start' => $this->input->post('Gol8Serial_start'),
            'Gol9Serial_start' => $this->input->post('Gol9Serial_start'),
            'DewasaEksekutifSerial_start' => $this->input->post('DewasaEksekutifSerial_start'),
            'BayiEksekutifSerial_start' => $this->input->post('BayiEksekutifSerial_start'),
            'DewasaBisnisSerial_start' => $this->input->post('DewasaBisnisSerial_start'),
            'BayiBisnisSerial_start' => $this->input->post('BayiBisnisSerial_start'),
            'DewasaEkonomiSerial_start' => $this->input->post('DewasaEkonomiSerial_start'),
            'BayiEkonomiSerial_start' => $this->input->post('BayiEkonomiSerial_start'),
            'Suplesi1DewasaSerial_start' => $this->input->post('Suplesi1DewasaSerial_start'),
            'Suplesi1AnakSerial_start' => $this->input->post('Suplesi1AnakSerial_start'),
            'Suplesi2DewasaSerial_start' => $this->input->post('Suplesi2DewasaSerial_start'),
            'Suplesi2AnakSerial_start' => $this->input->post('Suplesi2AnakSerial_start'),
            'HewanSerial_start' => $this->input->post('HewanSerial_start'),
            'GayorSerial_start' => $this->input->post('GayorSerial_start'),
            'CarterSerial_start' => $this->input->post('CarterSerial_start'),
            'ANGKPOSSerial_start' => $this->input->post('ANGKPOSSerial_start'),
            'BBMSerial_start' => $this->input->post('BBMSerial_start'),
            'BARTONSerial_start' => $this->input->post('BARTONSerial_start'),
            'BarangPendapatanSerial_start' => $this->input->post('barang_pendapatan_serial_start'),
            'Gol1Serial_end' => $this->input->post('Gol1Serial_end'),
            'Gol2Serial_end' => $this->input->post('Gol2Serial_end'),
            'Gol3Serial_end' => $this->input->post('Gol3Serial_end'),
            'Gol4PenSerial_end' => $this->input->post('Gol4PenSerial_end'),
            'Gol4BarSerial_end' => $this->input->post('Gol4BarSerial_end'),
            'Gol5PenSerial_end' => $this->input->post('Gol5PenSerial_end'),
            'Gol5BarSerial_end' => $this->input->post('Gol5BarSerial_end'),
            'Gol6PenSerial_end' => $this->input->post('Gol6PenSerial_end'),
            'Gol6BarSerial_end' => $this->input->post('Gol6BarSerial_end'),
            'Gol7Serial_end' => $this->input->post('Gol7Serial_end'),
            'Gol8Serial_end' => $this->input->post('Gol8Serial_end'),
            'Gol9Serial_end' => $this->input->post('Gol9Serial_end'),
            'DewasaEksekutifSerial_end' => $this->input->post('DewasaEksekutifSerial_end'),
            'BayiEksekutifSerial_end' => $this->input->post('BayiEksekutifSerial_end'),
            'DewasaBisnisSerial_end' => $this->input->post('DewasaBisnisSerial_end'),
            'BayiBisnisSerial_end' => $this->input->post('BayiBisnisSerial_end'),
            'DewasaEkonomiSerial_end' => $this->input->post('DewasaEkonomiSerial_end'),
            'BayiEkonomiSerial_end' => $this->input->post('BayiEkonomiSerial_end'),
            'Suplesi1DewasaSerial_end' => $this->input->post('Suplesi1DewasaSerial_end'),
            'Suplesi1AnakSerial_end' => $this->input->post('Suplesi1AnakSerial_end'),
            'Suplesi2DewasaSerial_end' => $this->input->post('Suplesi2DewasaSerial_end'),
            'Suplesi2AnakSerial_end' => $this->input->post('Suplesi2AnakSerial_end'),
            'HewanSerial_end' => $this->input->post('HewanSerial_end'),
            'GayorSerial_end' => $this->input->post('GayorSerial_end'),
            'CarterSerial_end' => $this->input->post('CarterSerial_end'),
            'ANGKPOSSerial_end' => $this->input->post('ANGKPOSSerial_end'),
            'BBMSerial_end' => $this->input->post('BBMSerial_end'),
            'BARTONSerial_end' => $this->input->post('BARTONSerial_end'),
            'BarangPendapatanSerial_end' => $this->input->post('barang_pendapatan_serial_end'),
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

        $valueWeek = '';
        if($this->input->post('tanggal_berangkat') <= 7) $valueWeek = 'W1';
        if($this->input->post('tanggal_berangkat') > 7 & $this->input->post('tanggal_berangkat') <= 14) $valueWeek = 'W1';
        if($this->input->post('tanggal_berangkat') > 7 & $this->input->post('tanggal_berangkat') <= 14) $valueWeek = 'W2';
        if($this->input->post('tanggal_berangkat') > 14 & $this->input->post('tanggal_berangkat') <= 21) $valueWeek = 'W3';
        if($this->input->post('tanggal_berangkat') > 21 & $this->input->post('tanggal_berangkat') <= 28) $valueWeek = 'W4';
        if($this->input->post('tanggal_berangkat') > 28 & $this->input->post('tanggal_berangkat') <= 31) $valueWeek = 'W5';
        
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
            'week' => $valueWeek,
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
            'ANGKPOS' => $this->input->post('ANGKPOS'),
            'BBM' => $this->input->post('BBM'),
            'BARTON' => $this->input->post('BARTON'),
            'BarangVolume' => $this->input->post('barang_volume'),
            'BarangPendapatan' => $this->input->post('barang_pendapatan'),
            'Gol1Serial_start' => $this->input->post('Gol1Serial_start'),
            'Gol2Serial_start' => $this->input->post('Gol2Serial_start'),
            'Gol3Serial_start' => $this->input->post('Gol3Serial_start'),
            'Gol4PenSerial_start' => $this->input->post('Gol4PenSerial_start'),
            'Gol4BarSerial_start' => $this->input->post('Gol4BarSerial_start'),
            'Gol5PenSerial_start' => $this->input->post('Gol5PenSerial_start'),
            'Gol5BarSerial_start' => $this->input->post('Gol5BarSerial_start'),
            'Gol6PenSerial_start' => $this->input->post('Gol6PenSerial_start'),
            'Gol6BarSerial_start' => $this->input->post('Gol6BarSerial_start'),
            'Gol7Serial_start' => $this->input->post('Gol7Serial_start'),
            'Gol8Serial_start' => $this->input->post('Gol8Serial_start'),
            'Gol9Serial_start' => $this->input->post('Gol9Serial_start'),
            'DewasaEksekutifSerial_start' => $this->input->post('DewasaEksekutifSerial_start'),
            'BayiEksekutifSerial_start' => $this->input->post('BayiEksekutifSerial_start'),
            'DewasaBisnisSerial_start' => $this->input->post('DewasaBisnisSerial_start'),
            'BayiBisnisSerial_start' => $this->input->post('BayiBisnisSerial_start'),
            'DewasaEkonomiSerial_start' => $this->input->post('DewasaEkonomiSerial_start'),
            'BayiEkonomiSerial_start' => $this->input->post('BayiEkonomiSerial_start'),
            'Suplesi1DewasaSerial_start' => $this->input->post('Suplesi1DewasaSerial_start'),
            'Suplesi1AnakSerial_start' => $this->input->post('Suplesi1AnakSerial_start'),
            'Suplesi2DewasaSerial_start' => $this->input->post('Suplesi2DewasaSerial_start'),
            'Suplesi2AnakSerial_start' => $this->input->post('Suplesi2AnakSerial_start'),
            'HewanSerial_start' => $this->input->post('HewanSerial_start'),
            'GayorSerial_start' => $this->input->post('GayorSerial_start'),
            'CarterSerial_start' => $this->input->post('CarterSerial_start'),
            'ANGKPOSSerial_start' => $this->input->post('ANGKPOSSerial_start'),
            'BBMSerial_start' => $this->input->post('BBMSerial_start'),
            'BARTONSerial_start' => $this->input->post('BARTONSerial_start'),
            'BarangPendapatanSerial_start' => $this->input->post('barang_pendapatan_serial_start'),
            'Gol1Serial_end' => $this->input->post('Gol1Serial_end'),
            'Gol2Serial_end' => $this->input->post('Gol2Serial_end'),
            'Gol3Serial_end' => $this->input->post('Gol3Serial_end'),
            'Gol4PenSerial_end' => $this->input->post('Gol4PenSerial_end'),
            'Gol4BarSerial_end' => $this->input->post('Gol4BarSerial_end'),
            'Gol5PenSerial_end' => $this->input->post('Gol5PenSerial_end'),
            'Gol5BarSerial_end' => $this->input->post('Gol5BarSerial_end'),
            'Gol6PenSerial_end' => $this->input->post('Gol6PenSerial_end'),
            'Gol6BarSerial_end' => $this->input->post('Gol6BarSerial_end'),
            'Gol7Serial_end' => $this->input->post('Gol7Serial_end'),
            'Gol8Serial_end' => $this->input->post('Gol8Serial_end'),
            'Gol9Serial_end' => $this->input->post('Gol9Serial_end'),
            'DewasaEksekutifSerial_end' => $this->input->post('DewasaEksekutifSerial_end'),
            'BayiEksekutifSerial_end' => $this->input->post('BayiEksekutifSerial_end'),
            'DewasaBisnisSerial_end' => $this->input->post('DewasaBisnisSerial_end'),
            'BayiBisnisSerial_end' => $this->input->post('BayiBisnisSerial_end'),
            'DewasaEkonomiSerial_end' => $this->input->post('DewasaEkonomiSerial_end'),
            'BayiEkonomiSerial_end' => $this->input->post('BayiEkonomiSerial_end'),
            'Suplesi1DewasaSerial_end' => $this->input->post('Suplesi1DewasaSerial_end'),
            'Suplesi1AnakSerial_end' => $this->input->post('Suplesi1AnakSerial_end'),
            'Suplesi2DewasaSerial_end' => $this->input->post('Suplesi2DewasaSerial_end'),
            'Suplesi2AnakSerial_end' => $this->input->post('Suplesi2AnakSerial_end'),
            'HewanSerial_end' => $this->input->post('HewanSerial_end'),
            'GayorSerial_end' => $this->input->post('GayorSerial_end'),
            'CarterSerial_end' => $this->input->post('CarterSerial_end'),
            'ANGKPOSSerial_end' => $this->input->post('ANGKPOSSerial_end'),
            'BBMSerial_end' => $this->input->post('BBMSerial_end'),
            'BARTONSerial_end' => $this->input->post('BARTONSerial_end'),
            'BarangPendapatanSerial_end' => $this->input->post('barang_pendapatan_serial_end'),
        ];
        $this->User_model->entry($dataInput);
        redirect('dashboard/entry');
    }
}