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
        $data['title'] = 'Produksi Harian';
        $data['contentView'] = 'pages/entry/dailyForm';
        $data['entry_data'] = $this->Entry_model->entryData();
        $data['entry_destination'] = $this->Entry_model->entryDestination();
        $data['produksi'] = $this->Entry_model->produksi();
        $data['lintasan'] = $this->Entry_model->lintasan();
        $data['pelabuhan'] = $this->Entry_model->pelabuhan();
        $data['kapal'] = $this->Entry_model->kapal();
        $this->load->view('template/dashboard/body', $data);
    }

    public function editEntryData()
    {
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
    public function editEntryDestination()
    {
        $data['title'] = 'Edit Data Destination';
        $data['contentView'] = 'pages/entry/editEntryDestination';
        $data['produksi'] = $this->Entry_model->produksi();
        $data['lintasan'] = $this->Entry_model->semuaLintasan();
        $data['pelabuhan'] = $this->Entry_model->semuaPelabuhan();
        $data['kapal'] = $this->Entry_model->kapal();
        $data['kapal_spv'] = $this->Entry_model->kapal_spv();
        $data['tarif'] = $this->Entry_model->tarif();
        $data['trip'] = $this->Entry_model->trip();
        $data['editDataDestination'] = $this->Entry_model->editEntryDestination($_GET['id']);
        $this->load->view('template/dashboard/body', $data);
    }

    public function prosesEditEntryDestination()
    {
        $dataInput = [
            'departure_time' => $this->input->post('edit_waktu_tiba'),
        ];
        $this->Entry_model->editData($dataInput, $_GET['id']);
        redirect('dashboard/entry');
    }

    public function prosesEditEntryData()
    {
        //AutoWeek
        $valueWeek = 0;
        if ((int)explode('-', $this->input->post('edit_tanggal_berangkat'))[2] <= 7) $valueWeek = 'W1';
        if ((int)explode('-', $this->input->post('edit_tanggal_berangkat'))[2] > 7 && (int)explode('-', $this->input->post('edit_tanggal_berangkat'))[2] <= 14) $valueWeek = 'W2';
        if ((int)explode('-', $this->input->post('edit_tanggal_berangkat'))[2] > 14 && (int)explode('-', $this->input->post('edit_tanggal_berangkat'))[2] <= 21) $valueWeek = 'W3';
        if ((int)explode('-', $this->input->post('edit_tanggal_berangkat'))[2] > 21 && (int)explode('-', $this->input->post('edit_tanggal_berangkat'))[2] <= 28) $valueWeek = 'W4';
        if ((int)explode('-', $this->input->post('edit_tanggal_berangkat'))[2] > 28 && (int)explode('-', $this->input->post('edit_tanggal_berangkat'))[2] <= 31) $valueWeek = 'W5';

        $tahun = 0;
        $bulan = 0;
        $tarif = $this->Entry_model->tarif();
        // $lintasan = $this->Entry_model->lintasanWIthId($dataIdLintasan);
        $lintasan = $this->Entry_model->lintasanWIthId($this->input->post('lintasan'));
        // $pelabuhan = $this->Entry_model->harbourWIthId($this->input->post('pelabuhan_asal'));
        // foreach($pelabuhan as $key => $value){
        //     $namaPelabuhan = str_replace(' ', '',ucwords(str_replace('-', ' ', strtolower($value['pelabuhan']))));
        // }
        foreach ($lintasan as $key => $value) {
            $namaLintasan = str_replace(' ', '', ucwords(str_replace('-', ' ', strtolower($value['lintasan']))));
            // $setelahExplode = explode('-',$value['lintasan']);
            // if(ucwords(strtolower($setelahExplode[0])) == $namaPelabuhan){
            //     $namaLintasan = $namaPelabuhan.ucwords(strtolower($setelahExplode[1]));
            // } else {
            //     $namaLintasan = $namaPelabuhan.ucwords(strtolower($setelahExplode[0]));
            // }
        }
        $valueTarif = '';
        // foreach ($tarif as $key => $value) {
        //     if (substr($value['tarif'], 0, strlen($value['tarif']) - 4) == $namaLintasan) {
        //         if (substr($value['tarif'], -2) >= $tahun) {
        //             $tahun = substr($value['tarif'], -2);
        //         }
        //     }
        // }
        foreach ($tarif as $key => $value) {
            if (substr($value['tarif'], 0, strlen($value['tarif']) - 4) == $namaLintasan) {
                // if ($tahun == substr($value['tarif'], -2) && substr($value['tarif'], -4, -2) >= $bulan) {
                //     $valueTarif = $value['tarif'];
                // }
                if ($tanggalMembeliTiket >  $value['tanggalBerlaku']) {
                    $valueTarif = $value['tarif'];
                } else {
                    break;
                }
            }
        }

        $dataInput = [
            'week' => $valueWeek,
            'departure_date' => $this->input->post('edit_tanggal_tiba'),
            'date' => $this->input->post('edit_tanggal_berangkat'),
            'time' => $this->input->post('edit_waktu_berangkat'),
            'departure_time' => $this->input->post('edit_waktu_tiba'),
            'id_ferry' => $this->input->post('nama_kapal'),
            'rate_type' => $valueTarif,
            'id_route' => $this->input->post('lintasan'),
            'id_harbour' => $this->input->post('pelabuhan_asal'),
            'id_trip' => $this->input->post('trip'),
            'Gol1' => (int) $this->input->post('Gol1') + (int) $this->input->post('Gol12') + (int) $this->input->post('Gol13'),
            'Gol2' => (int) $this->input->post('Gol2') + (int) $this->input->post('Gol22') + (int) $this->input->post('Gol23'),
            'Gol3' => (int) $this->input->post('Gol3') + (int) $this->input->post('Gol32') + (int) $this->input->post('Gol33'),
            'Gol4Pen' => (int) $this->input->post('Gol4Pen') + (int) $this->input->post('Gol4Pen2') + (int) $this->input->post('Gol4Pen3'),
            'Gol4Bar' => (int) $this->input->post('Gol4Bar') + (int) $this->input->post('Gol4Bar2') + (int) $this->input->post('Gol4Bar3'),
            'Gol5Pen' => (int) $this->input->post('Gol5Pen') + (int) $this->input->post('Gol5Pen2') + (int) $this->input->post('Gol5Pen3'),
            'Gol5Bar' => (int) $this->input->post('Gol5Bar') + (int) $this->input->post('Gol5Bar2') + (int) $this->input->post('Gol5Bar3'),
            'Gol6Pen' => (int) $this->input->post('Gol6Pen') + (int) $this->input->post('Gol6Pen2') + (int) $this->input->post('Gol6Pen3'),
            'Gol6Bar' => (int) $this->input->post('Gol6Bar') + (int) $this->input->post('Gol6Bar2') + (int) $this->input->post('Gol6Bar3'),
            'Gol7' => (int) $this->input->post('Gol7') + (int) $this->input->post('Gol72') + (int) $this->input->post('Gol73'),
            'Gol8' => (int) $this->input->post('Gol8') + (int) $this->input->post('Gol82') + (int) $this->input->post('Gol83'),
            'Gol9' => (int) $this->input->post('Gol9') + (int) $this->input->post('Gol92') + (int) $this->input->post('Gol93'),
            'DewasaEksekutif' => (int) $this->input->post('DewasaEksekutif') + (int) $this->input->post('DewasaEksekutif2') + (int) $this->input->post('DewasaEksekutif3'),
            'BayiEksekutif' => (int) $this->input->post('BayiEksekutif') + (int) $this->input->post('BayiEksekutif2') + (int) $this->input->post('BayiEksekutif3'),
            'DewasaBisnis' => (int) $this->input->post('DewasaBisnis') + (int) $this->input->post('DewasaBisnis2') + (int) $this->input->post('DewasaBisnis3'),
            'BayiBisnis' => (int) $this->input->post('BayiBisnis') + (int) $this->input->post('BayiBisnis2') + (int) $this->input->post('BayiBisnis3'),
            'DewasaEkonomi' => (int) $this->input->post('DewasaEkonomi') + (int) $this->input->post('DewasaEkonomi2') + (int) $this->input->post('DewasaEkonomi3'),
            'BayiEkonomi' => (int) $this->input->post('BayiEkonomi') + (int) $this->input->post('BayiEkonomi2') + (int) $this->input->post('BayiEkonomi3'),
            'Suplesi1Dewasa' => (int) $this->input->post('Suplesi1Dewasa') + (int) $this->input->post('Suplesi1Dewasa2') + (int) $this->input->post('Suplesi1Dewasa3'),
            'Suplesi1Anak' => (int) $this->input->post('Suplesi1Anak') + (int) $this->input->post('Suplesi1Anak2') + (int) $this->input->post('Suplesi1Anak3'),
            'Suplesi2Dewasa' => (int) $this->input->post('Suplesi2Dewasa') + (int) $this->input->post('Suplesi2Dewasa2') + (int) $this->input->post('Suplesi2Dewasa3'),
            'Suplesi2Anak' => (int) $this->input->post('Suplesi2Anak') + (int) $this->input->post('Suplesi2Anak2') + (int) $this->input->post('Suplesi2Anak3'),
            'Carter' => (int) $this->input->post('Carter') + (int) $this->input->post('Carter2') + (int) $this->input->post('Carter3'),
            'ANGKPOS' => (int) $this->input->post('ANGKPOS') + (int) $this->input->post('ANGKPOS2') + (int) $this->input->post('ANGKPOS3'),
            'BBM' => (int) $this->input->post('BBM') + (int) $this->input->post('BBM2') + (int) $this->input->post('BBM3'),
            'BARTON' => (int) $this->input->post('BARTON') + (int) $this->input->post('BARTON2') + (int) $this->input->post('BARTON3'),
            'BarangVolume' => (int) $this->input->post('BarangPendapatan') + (int)  $this->input->post('BarangPendapatan2') + (int)  $this->input->post('BarangPendapatan3'),
            'BarangPendapatan' => $this->input->post('barang_volume'),
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
            'CarterSerial_start' => $this->input->post('CarterSerial_start'),
            'ANGKPOSSerial_start' => $this->input->post('ANGKPOSSerial_start'),
            'BBMSerial_start' => $this->input->post('BBMSerial_start'),
            'BARTONSerial_start' => $this->input->post('BARTONSerial_start'),
            'BarangPendapatanSerial_start' => $this->input->post('BarangPendapatanSerial_start'),
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
            'CarterSerial_end' => $this->input->post('CarterSerial_end'),
            'ANGKPOSSerial_end' => $this->input->post('ANGKPOSSerial_end'),
            'BBMSerial_end' => $this->input->post('BBMSerial_end'),
            'BARTONSerial_end' => $this->input->post('BARTONSerial_end'),
            'BarangPendapatanSerial_end' => $this->input->post('BarangPendapatanSerial_end'),
            'Catatan' => $this->input->post('catatan'),
            // 'BuktiSetoran' => $this->input->post('bukti-setoran'),
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
    public function deleteEntryData()
    {
        $this->Entry_model->deleteEntryData($_GET['id']);
        redirect('dashboard/entry');
    }
    public function prosesEntry()
    {
        //AutoWeek
        $valueWeek = 0;
        if ((int)explode('-', $this->input->post('tanggal_berangkat'))[2] <= 7) $valueWeek = 'W1';
        if ((int)explode('-', $this->input->post('tanggal_berangkat'))[2] > 7 && (int)explode('-', $this->input->post('tanggal_berangkat'))[2] <= 14) $valueWeek = 'W2';
        if ((int)explode('-', $this->input->post('tanggal_berangkat'))[2] > 14 && (int)explode('-', $this->input->post('tanggal_berangkat'))[2] <= 21) $valueWeek = 'W3';
        if ((int)explode('-', $this->input->post('tanggal_berangkat'))[2] > 21 && (int)explode('-', $this->input->post('tanggal_berangkat'))[2] <= 28) $valueWeek = 'W4';
        if ((int)explode('-', $this->input->post('tanggal_berangkat'))[2] > 28 && (int)explode('-', $this->input->post('tanggal_berangkat'))[2] <= 31) $valueWeek = 'W5';

        //Auto JenisTarif
        $tahun = 0;
        $bulan = 0;
        $tarif = $this->Entry_model->tarif();
        $tanggalMembeliTiket = $this->input->post('tanggal_berangkat');
        // $lintasan = $this->Entry_model->lintasanWIthId($dataIdLintasan);
        $lintasan = $this->Entry_model->lintasanWIthId($this->input->post('lintasan'));
        // $pelabuhan = $this->Entry_model->harbourWIthId($this->input->post('pelabuhan_asal'));
        // foreach($pelabuhan as $key => $value){
        //     $namaPelabuhan = str_replace(' ', '',ucwords(str_replace('-', ' ', strtolower($value['pelabuhan']))));
        // }
        foreach ($lintasan as $key => $value) {
            $data['namaLintasan'] = str_replace(' ', '', ucwords(str_replace('-', ' ', strtolower($value['lintasan']))));
            // $setelahExplode = explode('-',$value['lintasan']);
            // if(ucwords(strtolower($setelahExplode[0])) == $namaPelabuhan){
            //     $data['namaLintasan'] = $namaPelabuhan.ucwords(strtolower($setelahExplode[1]));
            // } else {
            //     $data['namaLintasan'] = $namaPelabuhan.ucwords(strtolower($setelahExplode[0]));
            // }
        }
        $valueTarif = '';
        // foreach ($tarif as $key => $value) {
        //     if (substr($value['tarif'], 0, strlen($value['tarif']) - 4) == $data['namaLintasan']) {
        //         if (substr($value['tarif'], -2) >= $tahun) {
        //             $tahun = substr($value['tarif'], -2);
        //         }
        //     }
        // }
        foreach ($tarif as $key => $value) {
            if (substr($value['tarif'], 0, strlen($value['tarif']) - 4) == $data['namaLintasan']) {
                // if ($tahun <= substr($value['tarif'], -2) && substr($value['tarif'], -4, -2) >= $bulan ) {
                //     $valueTarif = $value['tarif'];
                //     $data['tarif'] = $valueTarif;
                // }
                if ($tanggalMembeliTiket >  $value['tanggalBerlaku']) {
                    $valueTarif = $value['tarif'];
                } else {
                    break;
                }
            }
        }


        $data['title'] = 'Entry Data';
        $data['contentView'] = 'pages/entry/testEntry';
        $this->load->view('template/dashboard/body', $data);

        $dataInput = [
            'week' => $valueWeek,
            'departure_date' => $this->input->post('tanggal_tiba'),
            'date' => $this->input->post('tanggal_berangkat'),
            'time' => $this->input->post('waktu_berangkat'),
            'departure_time' => $this->input->post('waktu_tiba'),
            'id_ferry' => $this->input->post('nama_kapal'),
            'rate_type' => $valueTarif,
            // 'id_route' => $dataIdLintasan,
            'id_route' => $this->input->post('lintasan'),
            'id_harbour' => $this->input->post('pelabuhan_asal'),
            'id_trip' => $this->input->post('trip'),
            'Gol1' => (int) $this->input->post('Gol1') + (int) $this->input->post('Gol12') + (int) $this->input->post('Gol13'),
            'Gol2' => (int) $this->input->post('Gol2') + (int) $this->input->post('Gol22') + (int) $this->input->post('Gol23'),
            'Gol3' => (int) $this->input->post('Gol3') + (int) $this->input->post('Gol32') + (int) $this->input->post('Gol33'),
            'Gol4Pen' => (int) $this->input->post('Gol4Pen') + (int) $this->input->post('Gol4Pen2') + (int) $this->input->post('Gol4Pen3'),
            'Gol4Bar' => (int) $this->input->post('Gol4Bar') + (int) $this->input->post('Gol4Bar2') + (int) $this->input->post('Gol4Bar3'),
            'Gol5Pen' => (int) $this->input->post('Gol5Pen') + (int) $this->input->post('Gol5Pen2') + (int) $this->input->post('Gol5Pen3'),
            'Gol5Bar' => (int) $this->input->post('Gol5Bar') + (int) $this->input->post('Gol5Bar2') + (int) $this->input->post('Gol5Bar3'),
            'Gol6Pen' => (int) $this->input->post('Gol6Pen') + (int) $this->input->post('Gol6Pen2') + (int) $this->input->post('Gol6Pen3'),
            'Gol6Bar' => (int) $this->input->post('Gol6Bar') + (int) $this->input->post('Gol6Bar2') + (int) $this->input->post('Gol6Bar3'),
            'Gol7' => (int) $this->input->post('Gol7') + (int) $this->input->post('Gol72') + (int) $this->input->post('Gol73'),
            'Gol8' => (int) $this->input->post('Gol8') + (int) $this->input->post('Gol82') + (int) $this->input->post('Gol83'),
            'Gol9' => (int) $this->input->post('Gol9') + (int) $this->input->post('Gol92') + (int) $this->input->post('Gol93'),
            'DewasaEksekutif' => (int) $this->input->post('DewasaEksekutif') + (int) $this->input->post('DewasaEksekutif2') + (int) $this->input->post('DewasaEksekutif3'),
            'BayiEksekutif' => (int) $this->input->post('BayiEksekutif') + (int) $this->input->post('BayiEksekutif2') + (int) $this->input->post('BayiEksekutif3'),
            'DewasaBisnis' => (int) $this->input->post('DewasaBisnis') + (int) $this->input->post('DewasaBisnis2') + (int) $this->input->post('DewasaBisnis3'),
            'BayiBisnis' => (int) $this->input->post('BayiBisnis') + (int) $this->input->post('BayiBisnis2') + (int) $this->input->post('BayiBisnis3'),
            'DewasaEkonomi' => (int) $this->input->post('DewasaEkonomi') + (int) $this->input->post('DewasaEkonomi2') + (int) $this->input->post('DewasaEkonomi3'),
            'BayiEkonomi' => (int) $this->input->post('BayiEkonomi') + (int) $this->input->post('BayiEkonomi2') + (int) $this->input->post('BayiEkonomi3'),
            'Suplesi1Dewasa' => (int) $this->input->post('Suplesi1Dewasa') + (int) $this->input->post('Suplesi1Dewasa2') + (int) $this->input->post('Suplesi1Dewasa3'),
            'Suplesi1Anak' => (int) $this->input->post('Suplesi1Anak') + (int) $this->input->post('Suplesi1Anak2') + (int) $this->input->post('Suplesi1Anak3'),
            'Suplesi2Dewasa' => (int) $this->input->post('Suplesi2Dewasa') + (int) $this->input->post('Suplesi2Dewasa2') + (int) $this->input->post('Suplesi2Dewasa3'),
            'Suplesi2Anak' => (int) $this->input->post('Suplesi2Anak') + (int) $this->input->post('Suplesi2Anak2') + (int) $this->input->post('Suplesi2Anak3'),
            'Carter' => (int) $this->input->post('Carter') + (int) $this->input->post('Carter2') + (int) $this->input->post('Carter3'),
            'ANGKPOS' => (int) $this->input->post('ANGKPOS') + (int) $this->input->post('ANGKPOS2') + (int) $this->input->post('ANGKPOS3'),
            'BBM' => (int) $this->input->post('BBM') + (int) $this->input->post('BBM2') + (int) $this->input->post('BBM3'),
            'BARTON' => (int) $this->input->post('BARTON') + (int) $this->input->post('BARTON2') + (int) $this->input->post('BARTON3'),
            'BarangVolume' => (int) $this->input->post('BarangPendapatan') + (int) $this->input->post('BarangPendapatan2') + (int) $this->input->post('BarangPendapatan3'),
            'BarangPendapatan' => $this->input->post('barang_volume'),
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
            'CarterSerial_start' => $this->input->post('CarterSerial_start'),
            'ANGKPOSSerial_start' => $this->input->post('ANGKPOSSerial_start'),
            'BBMSerial_start' => $this->input->post('BBMSerial_start'),
            'BARTONSerial_start' => $this->input->post('BARTONSerial_start'),
            'BarangPendapatanSerial_start' => $this->input->post('BarangPendapatanSerial_start'),
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
            'CarterSerial_end' => $this->input->post('CarterSerial_end'),
            'ANGKPOSSerial_end' => $this->input->post('ANGKPOSSerial_end'),
            'BBMSerial_end' => $this->input->post('BBMSerial_end'),
            'BARTONSerial_end' => $this->input->post('BARTONSerial_end'),
            'BarangPendapatanSerial_end' => $this->input->post('BarangPendapatanSerial_end'),
            'Gol12Serial_start' => $this->input->post('Gol12Serial_start'),
            'Gol22Serial_start' => $this->input->post('Gol22Serial_start'),
            'Gol32Serial_start' => $this->input->post('Gol32Serial_start'),
            'Gol4Pen2Serial_start' => $this->input->post('Gol4Pen2Serial_start'),
            'Gol4Bar2Serial_start' => $this->input->post('Gol4Bar2Serial_start'),
            'Gol5Pen2Serial_start' => $this->input->post('Gol5Pen2Serial_start'),
            'Gol5Bar2Serial_start' => $this->input->post('Gol5Bar2Serial_start'),
            'Gol6Pen2Serial_start' => $this->input->post('Gol6Pen2Serial_start'),
            'Gol6Bar2Serial_start' => $this->input->post('Gol6Bar2Serial_start'),
            'Gol72Serial_start' => $this->input->post('Gol72Serial_start'),
            'Gol82Serial_start' => $this->input->post('Gol82Serial_start'),
            'Gol92Serial_start' => $this->input->post('Gol92Serial_start'),
            'DewasaEksekutif2Serial_start' => $this->input->post('DewasaEksekutif2Serial_start'),
            'BayiEksekutif2Serial_start' => $this->input->post('BayiEksekutif2Serial_start'),
            'DewasaBisnis2Serial_start' => $this->input->post('DewasaBisnis2Serial_start'),
            'BayiBisnis2Serial_start' => $this->input->post('BayiBisnis2Serial_start'),
            'DewasaEkonomi2Serial_start' => $this->input->post('DewasaEkonomi2Serial_start'),
            'BayiEkonomi2Serial_start' => $this->input->post('BayiEkonomi2Serial_start'),
            'Suplesi1Dewasa2Serial_start' => $this->input->post('Suplesi1Dewasa2Serial_start'),
            'Suplesi1Anak2Serial_start' => $this->input->post('Suplesi1Anak2Serial_start'),
            'Suplesi2Dewasa2Serial_start' => $this->input->post('Suplesi2Dewasa2Serial_start'),
            'Suplesi2Anak2Serial_start' => $this->input->post('Suplesi2Anak2Serial_start'),
            'Carter2Serial_start' => $this->input->post('Carter2Serial_start'),
            'ANGKPOS2Serial_start' => $this->input->post('ANGKPOS2Serial_start'),
            'BBM2Serial_start' => $this->input->post('BBM2Serial_start'),
            'BARTON2Serial_start' => $this->input->post('BARTON2Serial_start'),
            'BarangPendapatan2Serial_start' => $this->input->post('BarangPendapatan2Serial_start'),
            'Gol12Serial_end' => $this->input->post('Gol12Serial_end'),
            'Gol22Serial_end' => $this->input->post('Gol22Serial_end'),
            'Gol32Serial_end' => $this->input->post('Gol32Serial_end'),
            'Gol4Pen2Serial_end' => $this->input->post('Gol4Pen2Serial_end'),
            'Gol4Bar2Serial_end' => $this->input->post('Gol4Bar2Serial_end'),
            'Gol5Pen2Serial_end' => $this->input->post('Gol5Pen2Serial_end'),
            'Gol5Bar2Serial_end' => $this->input->post('Gol5Bar2Serial_end'),
            'Gol6Pen2Serial_end' => $this->input->post('Gol6Pen2Serial_end'),
            'Gol6Bar2Serial_end' => $this->input->post('Gol6Bar2Serial_end'),
            'Gol72Serial_end' => $this->input->post('Gol72Serial_end'),
            'Gol82Serial_end' => $this->input->post('Gol82Serial_end'),
            'Gol92Serial_end' => $this->input->post('Gol92Serial_end'),
            'DewasaEksekutif2Serial_end' => $this->input->post('DewasaEksekutif2Serial_end'),
            'BayiEksekutif2Serial_end' => $this->input->post('BayiEksekutif2Serial_end'),
            'DewasaBisnis2Serial_end' => $this->input->post('DewasaBisnis2Serial_end'),
            'BayiBisnis2Serial_end' => $this->input->post('BayiBisnis2Serial_end'),
            'DewasaEkonomi2Serial_end' => $this->input->post('DewasaEkonomi2Serial_end'),
            'BayiEkonomi2Serial_end' => $this->input->post('BayiEkonomi2Serial_end'),
            'Suplesi1Dewasa2Serial_end' => $this->input->post('Suplesi1Dewasa2Serial_end'),
            'Suplesi1Anak2Serial_end' => $this->input->post('Suplesi1Anak2Serial_end'),
            'Suplesi2Dewasa2Serial_end' => $this->input->post('Suplesi2Dewasa2Serial_end'),
            'Suplesi2Anak2Serial_end' => $this->input->post('Suplesi2Anak2Serial_end'),
            'Carter2Serial_end' => $this->input->post('Carter2Serial_end'),
            'ANGKPOS2Serial_end' => $this->input->post('ANGKPOS2Serial_end'),
            'BBM2Serial_end' => $this->input->post('BBM2Serial_end'),
            'BARTON2Serial_end' => $this->input->post('BARTON2Serial_end'),
            'BarangPendapatan2Serial_end' => $this->input->post('BarangPendapatan2Serial_end'),
            'Gol13Serial_start' => $this->input->post('Gol13Serial_start'),
            'Gol23Serial_start' => $this->input->post('Gol23Serial_start'),
            'Gol33Serial_start' => $this->input->post('Gol33Serial_start'),
            'Gol4Pen2Serial_start' => $this->input->post('Gol4Pen2Serial_start'),
            'Gol4Bar2Serial_start' => $this->input->post('Gol4Bar2Serial_start'),
            'Gol5Pen2Serial_start' => $this->input->post('Gol5Pen2Serial_start'),
            'Gol5Bar2Serial_start' => $this->input->post('Gol5Bar2Serial_start'),
            'Gol6Pen2Serial_start' => $this->input->post('Gol6Pen2Serial_start'),
            'Gol6Bar2Serial_start' => $this->input->post('Gol6Bar2Serial_start'),
            'Gol73Serial_start' => $this->input->post('Gol73Serial_start'),
            'Gol83Serial_start' => $this->input->post('Gol83Serial_start'),
            'Gol93Serial_start' => $this->input->post('Gol93Serial_start'),
            'DewasaEksekutif3Serial_start' => $this->input->post('DewasaEksekutif3Serial_start'),
            'BayiEksekutif3Serial_start' => $this->input->post('BayiEksekutif3Serial_start'),
            'DewasaBisnis3Serial_start' => $this->input->post('DewasaBisnis3Serial_start'),
            'BayiBisnis3Serial_start' => $this->input->post('BayiBisnis3Serial_start'),
            'DewasaEkonomi3Serial_start' => $this->input->post('DewasaEkonomi3Serial_start'),
            'BayiEkonomi3Serial_start' => $this->input->post('BayiEkonomi3Serial_start'),
            'Suplesi1Dewasa3Serial_start' => $this->input->post('Suplesi1Dewasa3Serial_start'),
            'Suplesi1Anak3Serial_start' => $this->input->post('Suplesi1Anak3Serial_start'),
            'Suplesi2Dewasa3Serial_start' => $this->input->post('Suplesi2Dewasa3Serial_start'),
            'Suplesi2Anak3Serial_start' => $this->input->post('Suplesi2Anak3Serial_start'),
            'Carter3Serial_start' => $this->input->post('Carter3Serial_start'),
            'ANGKPOS3Serial_start' => $this->input->post('ANGKPOS3Serial_start'),
            'BBM3Serial_start' => $this->input->post('BBM3Serial_start'),
            'BARTON3Serial_start' => $this->input->post('BARTON3Serial_start'),
            'BarangPendapatan3Serial_start' => $this->input->post('BarangPendapatan3Serial_start'),
            'Gol13Serial_end' => $this->input->post('Gol13Serial_end'),
            'Gol23Serial_end' => $this->input->post('Gol23Serial_end'),
            'Gol33Serial_end' => $this->input->post('Gol33Serial_end'),
            'Gol4Pen3Serial_end' => $this->input->post('Gol4Pen3Serial_end'),
            'Gol4Bar3Serial_end' => $this->input->post('Gol4Bar3Serial_end'),
            'Gol5Pen3Serial_end' => $this->input->post('Gol5Pen3Serial_end'),
            'Gol5Bar3Serial_end' => $this->input->post('Gol5Bar3Serial_end'),
            'Gol6Pen3Serial_end' => $this->input->post('Gol6Pen3Serial_end'),
            'Gol6Bar3Serial_end' => $this->input->post('Gol6Bar3Serial_end'),
            'Gol73Serial_end' => $this->input->post('Gol73Serial_end'),
            'Gol83Serial_end' => $this->input->post('Gol83Serial_end'),
            'Gol93Serial_end' => $this->input->post('Gol93Serial_end'),
            'DewasaEksekutif3Serial_end' => $this->input->post('DewasaEksekutif3Serial_end'),
            'BayiEksekutif3Serial_end' => $this->input->post('BayiEksekutif3Serial_end'),
            'DewasaBisnis3Serial_end' => $this->input->post('DewasaBisnis3Serial_end'),
            'BayiBisnis3Serial_end' => $this->input->post('BayiBisnis3Serial_end'),
            'DewasaEkonomi3Serial_end' => $this->input->post('DewasaEkonomi3Serial_end'),
            'BayiEkonomi3Serial_end' => $this->input->post('BayiEkonomi3Serial_end'),
            'Suplesi1Dewasa3Serial_end' => $this->input->post('Suplesi1Dewasa3Serial_end'),
            'Suplesi1Anak3Serial_end' => $this->input->post('Suplesi1Anak3Serial_end'),
            'Suplesi2Dewasa3Serial_end' => $this->input->post('Suplesi2Dewasa3Serial_end'),
            'Suplesi2Anak3Serial_end' => $this->input->post('Suplesi2Anak3Serial_end'),
            'Carter3Serial_end' => $this->input->post('Carter3Serial_end'),
            'ANGKPOS3Serial_end' => $this->input->post('ANGKPOS3Serial_end'),
            'BBM3Serial_end' => $this->input->post('BBM3Serial_end'),
            'BARTON3Serial_end' => $this->input->post('BARTON3Serial_end'),
            'BarangPendapatan3Serial_end' => $this->input->post('BarangPendapatan3Serial_end'),
            'Catatan' => $this->input->post('catatan'),
        ];
        $this->User_model->entry($dataInput);
        redirect('dashboard/entry');
    }
}
