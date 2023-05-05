<?php
require FCPATH . 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;

class Report extends CI_Controller
{

    public $employee;

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('ciqrcode');
        $this->employee = $this->Report_model->employee();
    }
    //Bikin Code QR Ke Folder signatureQR
    function qr($kodeqr)
    {
        if ($kodeqr) {
            $filename = 'assets/images/signatureQR/' . $kodeqr;
            if (!file_exists($filename)) {
                $params['data'] = $kodeqr;
                $params['level'] = 'H';
                $params['size'] = 10;
                $params['savename'] = FCPATH . 'assets/images/signatureQR/' . $kodeqr . ".png";
                return  $this->ciqrcode->generate($params);
            }
        }
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
        // $this->qr('www.recons-luwuk.com/pegawai/id?=4');

        $this->load->view('template/dashboard/body', $data);
    }

    public function buktiPenyetoran()
    {

        $data['title'] = 'Bukti Penyetoran';
        $data['contentView'] = 'report/buktiPenyetoran';

        $data['tarif'] = $this->Master_model->rate();
        $data['produksi'] = $this->Entry_model->produksi();
        $data['lintasan'] = $this->Master_model->lintasan();
        $data['pelabuhan'] = $this->Master_model->pelabuhan();
        $data['kapal'] = $this->Master_model->kapal_spv();
        $data['tarif'] = $this->Master_model->tarif();



        $this->load->view('template/dashboard/body', $data);
        // redirect(base_url('dashboard/report'));
    }

    public function downloadBuktiPenyetoran()
    {
        $koneksi = mysqli_connect("217.21.72.151", "u1578336_admin", "5september_", "u1578336_db_recons_luwuk");

        $title = 'Bukti Penyetoran';
        $kapalReport = $this->input->post('nama_kapal');
        $tripReport = $this->input->post('trip');
        $pelabuhanReport = $this->input->post('pelabuhan_asal_report');
        $lintasanReport = $this->input->post('lintasan_report');
        $tanggalAwalReport = $this->input->post('tanggal_awal');
        $jamReport = $this->input->post('jam');
        $supervisor = $this->Report_model->supervisorName();



        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $entryData = mysqli_query($koneksi, "
        SELECT *,dayname(date), 
        entry_data.DewasaEksekutif AS 'Jumlah DewasaEksekutif', entry_data.BayiEksekutif  AS 'Jumlah BayiEksekutif', entry_data.DewasaBisnis AS 'Jumlah DewasaBisnis', entry_data.BayiBisnis AS 'Jumlah BayiBisnis', entry_data.DewasaEkonomi AS 'Jumlah DewasaEkonomi', entry_data.BayiEkonomi AS 'Jumlah BayiEkonomi',
        entry_data.Gol1 as 'Jumlah Gol1', entry_data.Gol2 as 'Jumlah Gol2', entry_data.Gol3 as 'Jumlah Gol3', entry_data.Gol4Pen as 'Jumlah Gol4Pen', entry_data.Gol4Bar as 'Jumlah Gol4Bar', entry_data.Gol5Pen as 'Jumlah Gol5Pen',entry_data.Gol5Bar as 'Jumlah Gol5Bar',entry_data.Gol6Pen as 'Jumlah Gol6Pen',entry_data.Gol6Bar as 'Jumlah Gol6Bar',entry_data.Gol7 as 'Jumlah Gol7',entry_data.Gol8 as 'Jumlah Gol8',entry_data.Gol9 as 'Jumlah Gol9', 
        (rate.DewasaEksekutif * entry_data.DewasaEksekutif) as 'Dewasa Eksekutif',
        (rate.BayiEksekutif * entry_data.BayiEksekutif) as 'Bayi Eksekutif',
        (rate.DewasaBisnis * entry_data.DewasaBisnis) as 'Dewasa Bisnis',
        (rate.BayiBisnis * entry_data.BayiBisnis) as 'Bayi Bisnis',
        (rate.DewasaEkonomi * entry_data.DewasaEkonomi) as 'Dewasa Ekonomi',
        (rate.BayiEkonomi * entry_data.BayiEkonomi) as 'Bayi Ekonomi',
        (rate.Gol1 * entry_data.Gol1) as 'Golongan 1',
        (rate.Gol2 * entry_data.Gol2) as 'Golongan 2',
        (rate.Gol3 * entry_data.Gol3) as 'Golongan 3',
        (rate.Gol4Pen * entry_data.Gol4Pen) as 'Golongan 4 Penumpang',
        (rate.Gol4Bar * entry_data.Gol4Bar) as 'Golongan 4 Barang',
        (rate.Gol5Pen * entry_data.Gol5Pen) as 'Golongan 5 Penumpang',
        (rate.Gol5Bar * entry_data.Gol5Bar) as 'Golongan 5 Barang',
        (rate.Gol6Pen * entry_data.Gol6Pen) as 'Golongan 6 Penumpang',
        (rate.Gol6Bar * entry_data.Gol6Bar) as 'Golongan 6 Barang',
        (rate.Gol7 * entry_data.Gol7) as 'Golongan 7',
        (rate.Gol8 * entry_data.Gol8) as 'Golongan 8',
        (rate.Gol9 * entry_data.Gol9) as 'Golongan 9',
        entry_data.BarangVolume as 'Entry Barang Volume'
        FROM entry_data
        JOIN ferry ON ferry.id = entry_data.id_ferry
        JOIN routes ON routes.id = entry_data.id_route
        JOIN harbours on harbours.id_harbours = entry_data.id_harbour
        JOIN rate ON rate.id_route = routes.id and entry_data.date >= rate.start_date and rate.rate_type = entry_data.rate_type
        WHERE date='{$tanggalAwalReport}' and ferry = '{$kapalReport}' and route = '{$lintasanReport}'
    ");

        // sheet peratama
        $sheet->setTitle($title);
        $sheet->mergeCells('A1:J1')->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->mergeCells('A2:D2')->getStyle('A2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
        $sheet->mergeCells('A3:D3')->getStyle('A3')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
        $sheet->mergeCells('A4:D4')->getStyle('A4')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
        $sheet->mergeCells('A5:D5')->getStyle('A5')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
        $sheet->mergeCells('A6:D6')->getStyle('A6')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
        $sheet->mergeCells('E2:J2')->getStyle('E2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
        $sheet->mergeCells('E3:J3')->getStyle('E3')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
        $sheet->mergeCells('E4:J4')->getStyle('E4')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
        $sheet->mergeCells('E5:J5')->getStyle('E5')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
        $sheet->mergeCells('E6:J6')->getStyle('E6')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
        $sheet->mergeCells('A7:A8')->getStyle('A7')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $sheet->mergeCells('B7:B8')->getStyle('B7')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $sheet->mergeCells('C7:D7')->getStyle('C7')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->mergeCells('E7:F7')->getStyle('E7')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->mergeCells('G7:G8')->getStyle('G7')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $sheet->mergeCells('J7:J8')->getStyle('J7')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $sheet->mergeCells('H7:I7')->getStyle('H7')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->mergeCells('B9:J9')->getStyle('B9')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->mergeCells('B17:J17')->getStyle('B17')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->mergeCells('B31:J31')->getStyle('B31')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->mergeCells('C16:F16')->getStyle('B31')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->mergeCells('C30:F30')->getStyle('B31')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->mergeCells('C33:F33')->getStyle('B31')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->mergeCells('C34:F34')->getStyle('B31')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->mergeCells('C35:J35')->getStyle('B31')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $sheet->mergeCells('A9:A16')->getStyle('A9')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->mergeCells('A17:A30')->getStyle('A17')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->mergeCells('A31:A34')->getStyle('A31')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->mergeCells('B38:B40')->getStyle('B38')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->mergeCells('E38:E40')->getStyle('E38')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->mergeCells('I38:I40')->getStyle('I38')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $sheet->setCellValue('A1', $title);
        $sheet->setCellValue('A2', 'Hari');
        $sheet->setCellValue('A3', 'Tanggal');
        $sheet->setCellValue('A4', 'Pelabuhan');
        $sheet->setCellValue('A5', 'Lintas');
        $sheet->setCellValue('A6', 'Jam Pemberangkatan');
        $sheet->setCellValue('E2', getHari($tanggalAwalReport));
        $sheet->setCellValue('E3', $tanggalAwalReport);
        $sheet->setCellValue('E4', $pelabuhanReport);
        $sheet->setCellValue('E5', $lintasanReport);
        $sheet->setCellValue('C7', 'Tarif');
        $sheet->setCellValue('E7', 'Nomor Seri Terjual');
        $sheet->setCellValue('H7', 'Pendapatan');
        $sheet->setCellValue('A7', 'No');
        $sheet->setCellValue('B7', 'Jenis Tiket');
        $sheet->setCellValue('C8', 'Pelayaran');
        $sheet->setCellValue('D8', 'Asuransi');
        $sheet->setCellValue('E8', 'Awal');
        $sheet->setCellValue('F8', 'Akhir');
        $sheet->setCellValue('G7', 'Jumlah');
        $sheet->setCellValue('H8', 'Pelayaran');
        $sheet->setCellValue('I8', 'Asuransi');
        $sheet->setCellValue('J7', 'Jumlah');
        $sheet->setCellValue('A9', 'I');
        $sheet->setCellValue('B9', 'Tiket Penumpang');
        $sheet->setCellValue('B10', 'Dewasa Eksekutif');
        $sheet->setCellValue('B11', 'Anak Eksekutif');
        $sheet->setCellValue('B12', 'Dewasa Bisnis');
        $sheet->setCellValue('B13', 'Anak Bisnis');
        $sheet->setCellValue('B14', 'Dewasa Ekonomi');
        $sheet->setCellValue('B15', 'Anak Ekonomi');
        $sheet->setCellValue('B16', 'Jumlah Penumpang');

        $sheet->setCellValue('A17', 'II');
        $sheet->setCellValue('B17', 'Tiket Kendaraan');
        $sheet->setCellValue('B18', 'Golongan I');
        $sheet->setCellValue('B19', 'Golongan II');
        $sheet->setCellValue('B20', 'Golongan III');
        $sheet->setCellValue('B21', 'Golongan IV Penumpang');
        $sheet->setCellValue('B22', 'Golongan IV Barang');
        $sheet->setCellValue('B23', 'Golongan V Penumpang');
        $sheet->setCellValue('B24', 'Golongan V Barang');
        $sheet->setCellValue('B25', 'Golongan VI Penumpang');
        $sheet->setCellValue('B26', 'Golongan VI Barang');
        $sheet->setCellValue('B27', 'Golongan VII');
        $sheet->setCellValue('B28', 'Golongan VIII');
        $sheet->setCellValue('B29', 'Golongan IX');
        $sheet->setCellValue('B30', 'Jumlah Kendaraan');

        $sheet->setCellValue('A31', 'III');
        $sheet->setCellValue('B31', 'Barang');
        $sheet->setCellValue('B32', 'Barang Curah');
        $sheet->setCellValue('B33', 'Jumlah Barang');
        $sheet->setCellValue('B34', 'Jumlah');
        $sheet->setCellValue('B35', 'Terbilang');
        foreach ($this->employee as $row) {
            if ($row['position'] == "MANAGER USAHA") {
                $sheet->setCellValue('B37', 'MANAGER USAHA');
                $sheet->setCellValue('B41', $row['name']);
                $sheet->setCellValue('B42', 'NIK ' . $row['id_num']);
            }
            if ($row['position'] == "KASIR") {
                $sheet->setCellValue('E37', 'KASIR');
                $sheet->setCellValue('E41', $row['name']);
                $sheet->setCellValue('E42', 'NIK ' . $row['id_num']);
            }
        }
        foreach ($supervisor as $row) {
            $sheet->setCellValue('I37', $row['position']);
            $sheet->setCellValue('I41', $row['name']);
            $sheet->setCellValue('I42', 'NIK ' . $row['id_num']);
        }


        for ($col = 'A'; $col !== 'K'; $col++) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }
        $sheet->getStyle('C35')->getAlignment()->setWrapText(true);

        $styleArray = ['borders' => ['allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,],]];
        $sheet->getStyle('A1:J35')->applyFromArray($styleArray);
        $styleArrayOutline = ['borders' => ['outline' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,],]];
        $sheet->getStyle('A36:J45')->applyFromArray($styleArrayOutline);
        $sheet->getPageSetup()->setPrintArea('A1:J42', \PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::SETPRINTRANGE_INSERT);
        // $sheet->setBreak('A1:J42',\PhpOffice\PhpSpreadsheet\Worksheet\Worksheet::BREAK_ROW);


        while ($record = mysqli_fetch_array($entryData)) {
            if (!$record['time']) {
                $sheet->setCellValue('E6', $jamReport);
            } else {
                $sheet->setCellValue('E6', $record['time']);
            }

            // Tarif Pelayaran
            $sheet->setCellValue('C10', $record['DewasaEksekutif']);
            $sheet->setCellValue('C11', $record['BayiEksekutif']);
            $sheet->setCellValue('C12', $record['DewasaBisnis']);
            $sheet->setCellValue('C13', $record['BayiBisnis']);
            $sheet->setCellValue('C14', $record['DewasaEkonomi']);
            $sheet->setCellValue('C15', $record['BayiEkonomi']);

            // Tarif Asuransi
            $sheet->setCellValue('D10', $record['DewasaEksekutifTJP']);
            $sheet->setCellValue('D11', $record['BayiEksekutifTJP']);
            $sheet->setCellValue('D12', $record['DewasaBisnisTJP']);
            $sheet->setCellValue('D13', $record['BayiBisnisTJP']);
            $sheet->setCellValue('D14', $record['DewasaEkonomiTJP']);
            $sheet->setCellValue('D15', $record['BayiEkonomiTJP']);

            // Jumlah
            $sheet->setCellValue('G10', $record['Jumlah DewasaEksekutif']);
            $sheet->setCellValue('G11', $record['Jumlah BayiEksekutif']);
            $sheet->setCellValue('G12', $record['Jumlah DewasaBisnis']);
            $sheet->setCellValue('G13', $record['Jumlah BayiBisnis']);
            $sheet->setCellValue('G14', $record['Jumlah DewasaEkonomi']);
            $sheet->setCellValue('G15', $record['Jumlah BayiEkonomi']);
            $sheet->setCellValue('G16', '=SUM(G10:G15)');

            // Pendapatan Pelayaran
            $sheet->setCellValue('H10', $record['Dewasa Eksekutif']);
            $sheet->setCellValue('H11', $record['Bayi Eksekutif']);
            $sheet->setCellValue('H12', $record['Dewasa Bisnis']);
            $sheet->setCellValue('H13', $record['Bayi Bisnis']);
            $sheet->setCellValue('H14', $record['Dewasa Ekonomi']);
            $sheet->setCellValue('H15', $record['Bayi Ekonomi']);
            $sheet->setCellValue('H16', '=SUM(H10:H15)');

            // Pendapatan Asuransi
            $sheet->setCellValue('I10', '=D10 * G10');
            $sheet->setCellValue('I11', '=D11 * G11');
            $sheet->setCellValue('I12', '=D12 * G12');
            $sheet->setCellValue('I13', '=D13 * G13');
            $sheet->setCellValue('I14', '=D14 * G14');
            $sheet->setCellValue('I15', '=D15 * G15');
            $sheet->setCellValue('I16', '=SUM(I10:I15)');

            // Jumlah
            $sheet->setCellValue('J10', '=H10 + I10');
            $sheet->setCellValue('J11', '=H11 + I11');
            $sheet->setCellValue('J12', '=H12 + I12');
            $sheet->setCellValue('J13', '=H13 + I13');
            $sheet->setCellValue('J14', '=H14 + I14');
            $sheet->setCellValue('J15', '=H15 + I15');
            $sheet->setCellValue('J16', '=SUM(J10:J15)');

            // Tarif Pelayaran
            $sheet->setCellValue('C18', $record['Gol1']);
            $sheet->setCellValue('C19', $record['Gol2']);
            $sheet->setCellValue('C20', $record['Gol3']);
            $sheet->setCellValue('C21', $record['Gol4Pen']);
            $sheet->setCellValue('C22', $record['Gol4Bar']);
            $sheet->setCellValue('C23', $record['Gol5Pen']);
            $sheet->setCellValue('C24', $record['Gol5Bar']);
            $sheet->setCellValue('C25', $record['Gol6Pen']);
            $sheet->setCellValue('C26', $record['Gol6Bar']);
            $sheet->setCellValue('C27', $record['Gol7']);
            $sheet->setCellValue('C28', $record['Gol8']);
            $sheet->setCellValue('C29', $record['Gol9']);

            // Tarif Asuransi
            $sheet->setCellValue('D18', $record['Gol1TJP']);
            $sheet->setCellValue('D19', $record['Gol2TJP']);
            $sheet->setCellValue('D20', $record['Gol3TJP']);
            $sheet->setCellValue('D21', $record['Gol4PenTJP']);
            $sheet->setCellValue('D22', $record['Gol4BarTJP']);
            $sheet->setCellValue('D23', $record['Gol5PenTJP']);
            $sheet->setCellValue('D24', $record['Gol5BarTJP']);
            $sheet->setCellValue('D25', $record['Gol6PenTJP']);
            $sheet->setCellValue('D26', $record['Gol6BarTJP']);
            $sheet->setCellValue('D27', $record['Gol7TJP']);
            $sheet->setCellValue('D28', $record['Gol8TJP']);
            $sheet->setCellValue('D29', $record['Gol9TJP']);

            // Pendapatan Pelayaran
            $sheet->setCellValue('H18', '=C18 * G18');
            $sheet->setCellValue('H19', '=C19 * G19');
            $sheet->setCellValue('H20', '=C20 * G20');
            $sheet->setCellValue('H21', '=C21 * G21');
            $sheet->setCellValue('H22', '=C22 * G22');
            $sheet->setCellValue('H23', '=C23 * G23');
            $sheet->setCellValue('H24', '=C24 * G24');
            $sheet->setCellValue('H25', '=C25 * G25');
            $sheet->setCellValue('H26', '=C26 * G26');
            $sheet->setCellValue('H27', '=C27 * G27');
            $sheet->setCellValue('H28', '=C28 * G28');
            $sheet->setCellValue('H29', '=C29 * G29');
            $sheet->setCellValue('H30', '=SUM(H18:H29)');

            // Jumlah
            $sheet->setCellValue('G18', $record['Jumlah Gol1']);
            $sheet->setCellValue('G19', $record['Jumlah Gol2']);
            $sheet->setCellValue('G20', $record['Jumlah Gol3']);
            $sheet->setCellValue('G21', $record['Jumlah Gol4Pen']);
            $sheet->setCellValue('G22', $record['Jumlah Gol4Bar']);
            $sheet->setCellValue('G23', $record['Jumlah Gol5Pen']);
            $sheet->setCellValue('G24', $record['Jumlah Gol5Bar']);
            $sheet->setCellValue('G25', $record['Jumlah Gol6Pen']);
            $sheet->setCellValue('G26', $record['Jumlah Gol6Bar']);
            $sheet->setCellValue('G27', $record['Jumlah Gol7']);
            $sheet->setCellValue('G28', $record['Jumlah Gol8']);
            $sheet->setCellValue('G29', $record['Jumlah Gol9']);
            $sheet->setCellValue('G30', '=SUM(G18:G29)');

            // Pendapatan Asuransi
            $sheet->setCellValue('I18', '=D18 * G18');
            $sheet->setCellValue('I19', '=D19 * G19');
            $sheet->setCellValue('I20', '=D20 * G20');
            $sheet->setCellValue('I21', '=D21 * G21');
            $sheet->setCellValue('I22', '=D22 * G22');
            $sheet->setCellValue('I23', '=D23 * G23');
            $sheet->setCellValue('I24', '=D24 * G24');
            $sheet->setCellValue('I25', '=D25 * G25');
            $sheet->setCellValue('I26', '=D26 * G26');
            $sheet->setCellValue('I27', '=D27 * G27');
            $sheet->setCellValue('I28', '=D28 * G28');
            $sheet->setCellValue('I29', '=D29 * G29');
            $sheet->setCellValue('I30', '=SUM(I18:I29)');

            // Jumlah
            $sheet->setCellValue('J18', '=H18 + I18');
            $sheet->setCellValue('J19', '=H19 + I19');
            $sheet->setCellValue('J20', '=H20 + I20');
            $sheet->setCellValue('J21', '=H21 + I21');
            $sheet->setCellValue('J22', '=H22 + I22');
            $sheet->setCellValue('J23', '=H23 + I23');
            $sheet->setCellValue('J24', '=H24 + I24');
            $sheet->setCellValue('J25', '=H25 + I25');
            $sheet->setCellValue('J26', '=H26 + I26');
            $sheet->setCellValue('J27', '=H27 + I27');
            $sheet->setCellValue('J28', '=H28 + I28');
            $sheet->setCellValue('J29', '=H29 + I29');
            $sheet->setCellValue('J30', '=SUM(J18:J29)');

            // Jumlah
            $sheet->setCellValue('G32', $record['Entry Barang Volume']);

            $Curah = 0;
            if ($record['Entry Barang Volume'] != 0)
                $record['BarangPendapatan'] / $record['Entry Barang Volume'];

            //Pendapatan Pelayaran
            $sheet->setCellValue('H32', $Curah);
            //Asuransi Pendapatan
            $sheet->setCellValue('I32', 0);
            //Jumlah Pendapatan
            $sheet->setCellValue('J32', $record['BarangPendapatan']);

            //Jumlah Barang
            $sheet->setCellValue('G33', '=G32');
            $sheet->setCellValue('H33', '=H32');
            $sheet->setCellValue('I33', '=I32');
            $sheet->setCellValue('J33', '=J32');

            //Jumlah Total
            $sheet->setCellValue('G34', '=G16 + G30 + G33');
            $sheet->setCellValue('H34', '=H16 + H30 + H33');
            $sheet->setCellValue('I34', '=I16 + I30 + I33');
            $sheet->setCellValue('J34', '=J16 + J30 + J33');

            $sheet->setCellValue('C35', strtoupper(terbilang($sheet->getCell('J34')->getCalculatedValue())));
        }


        // $sheet->getStyle('C10:J16')->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_ACCOUNTING_EUR);
        // $sheet->getStyle('C18:J30')->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_0);
        // $sheet->getStyle('C32:J34')->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_0);

        $styleArray = array(
            'allBorders' => array(
                'outline' => array(
                    'style' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                    'color' => array('argb' => 'FFFF0000'),
                ),
            ),
        );

        $sheet = $sheet->getStyle('A1:J45')->applyFromArray($styleArray);


        $writer = new Xlsx($spreadsheet);
        ob_start();
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename="' . urlencode($title . " " . $lintasanReport . " " . $tanggalAwalReport . ".xlsx") . '"');
        ob_end_clean();
        $writer->save('php://output');
        exit();
    }

    public function dailyReport()
    {
        $data['title'] = 'Laporan Pendapatan Harian';
        $data['contentView'] = 'report/dailyReport';

        $data['tarif'] = $this->Master_model->rate();
        $data['produksi'] = $this->Entry_model->produksi();
        $data['lintasan'] = $this->Master_model->lintasan();
        $data['pelabuhan'] = $this->Master_model->pelabuhan();
        $data['kapal'] = $this->Master_model->kapal_spv();
        $data['tarif'] = $this->Master_model->tarif();

        $this->load->view('template/dashboard/body', $data);
        // redirect('index');

    }

    public function downloadDailyReport()
    {

        // koneksi php dan mysql
        // $koneksi = mysqli_connect("localhost","root","","asdp_luwuk");
        $koneksi = mysqli_connect("217.21.72.151", "u1578336_admin", "5september_", "u1578336_db_recons_luwuk");

        $title = 'Laporan Pendapatan Harian';
        $kapalReport = $this->input->post('nama_kapal');
        $lintasanReport = $this->input->post('lintasan_report');
        $tanggalAwalReport = $this->input->post('tanggal_berangkat');
        $tanggalAkhirReport = $this->input->post('tanggal_akhir');
        $supervisor = $this->Report_model->supervisorName();
        $tripReport = $this->input->post('trip');
        $pelabuhanReport = $this->input->post('pelabuhan_asal_report');
        $jamReport = $this->input->post('jam');

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();


        $entryData = mysqli_query($koneksi, "
            SELECT *,dayname(date), 
            sum(entry_data.DewasaEksekutif) AS 'Jumlah DewasaEksekutif', sum(entry_data.BayiEksekutif ) AS 'Jumlah BayiEksekutif', sum(entry_data.DewasaBisnis) AS 'Jumlah DewasaBisnis', sum(entry_data.BayiBisnis) AS 'Jumlah BayiBisnis', sum(entry_data.DewasaEkonomi) AS 'Jumlah DewasaEkonomi', sum(entry_data.BayiEkonomi) AS 'Jumlah BayiEkonomi', sum(entry_data.BarangVolume) AS 'Jumlah BarangVolume', sum(entry_data.BarangPendapatan) AS 'Jumlah BarangPendapatan',
            sum(entry_data.Gol1) as 'Jumlah Gol1', sum(entry_data.Gol2) as 'Jumlah Gol2', sum(entry_data.Gol3) as 'Jumlah Gol3', sum(entry_data.Gol4Pen) as 'Jumlah Gol4Pen', sum(entry_data.Gol4Bar) as 'Jumlah Gol4Bar', sum(entry_data.Gol5Pen) as 'Jumlah Gol5Pen',sum(entry_data.Gol5Bar) as 'Jumlah Gol5Bar',sum(entry_data.Gol6Pen) as 'Jumlah Gol6Pen',sum(entry_data.Gol6Bar) as 'Jumlah Gol6Bar',sum(entry_data.Gol7) as 'Jumlah Gol7',sum(entry_data.Gol8) as 'Jumlah Gol8',sum(entry_data.Gol9) as 'Jumlah Gol9',
            sum(entry_data.Suplesi1Dewasa) as 'Jumlah Suplesi1Dewasa', sum(entry_data.Suplesi2Dewasa) as 'Jumlah Suplesi2Dewasa', sum(entry_data.Suplesi1Anak) as 'Jumlah Suplesi1Anak', sum(entry_data.Suplesi2Anak) as 'Jumlah Suplesi2Anak',

            sum((rate.DewasaEksekutif * entry_data.DewasaEksekutif)) as 'Dewasa Eksekutif',
            sum((rate.BayiEksekutif * entry_data.BayiEksekutif)) as 'Bayi Eksekutif',
            sum((rate.DewasaBisnis * entry_data.DewasaBisnis)) as 'Dewasa Bisnis',
            sum((rate.BayiBisnis * entry_data.BayiBisnis)) as 'Bayi Bisnis',
            sum((rate.DewasaEkonomi * entry_data.DewasaEkonomi)) as 'Dewasa Ekonomi',
            sum((rate.BayiEkonomi * entry_data.BayiEkonomi)) as 'Bayi Ekonomi',
            sum((rate.Gol1 * entry_data.Gol1)) as 'Golongan 1',
            sum((rate.Gol2 * entry_data.Gol2)) as 'Golongan 2',
            sum((rate.Gol3 * entry_data.Gol3)) as 'Golongan 3',
            sum((rate.Gol4Pen * entry_data.Gol4Pen)) as 'Golongan 4 Penumpang',
            sum((rate.Gol4Bar * entry_data.Gol4Bar)) as 'Golongan 4 Barang',
            sum((rate.Gol5Pen * entry_data.Gol5Pen)) as 'Golongan 5 Penumpang',
            sum((rate.Gol5Bar * entry_data.Gol5Bar)) as 'Golongan 5 Barang',
            sum((rate.Gol6Pen * entry_data.Gol6Pen)) as 'Golongan 6 Penumpang',
            sum((rate.Gol6Bar * entry_data.Gol6Bar)) as 'Golongan 6 Barang',
            sum((rate.Gol7 * entry_data.Gol7)) as 'Golongan 7',
            sum((rate.Gol8 * entry_data.Gol8)) as 'Golongan 8',
            sum((rate.Gol9 * entry_data.Gol9)) as 'Golongan 9',
            sum(entry_data.BarangPendapatan) as 'Barang Pendapatan',
            sum(entry_data.BarangVolume) as 'Entry Barang Volume',
            sum((rate.Suplesi1Dewasa * entry_data.Suplesi1Dewasa)) as 'Suplesi1 Dewasa',
            sum((rate.Suplesi1Anak * entry_data.Suplesi1Anak)) as 'Suplesi1 Anak',
            sum((rate.Suplesi2Dewasa * entry_data.Suplesi2Dewasa)) as 'Suplesi2 Dewasa',
            sum((rate.Suplesi2Anak * entry_data.Suplesi2Anak)) as 'Suplesi2 Anak'
            FROM entry_data
            JOIN ferry ON ferry.id = entry_data.id_ferry
            JOIN routes ON routes.id = entry_data.id_route
            JOIN harbours on harbours.id_harbours = entry_data.id_harbour
            JOIN rate ON rate.id_route = routes.id and entry_data.date >= rate.start_date and rate.rate_type = entry_data.rate_type
            WHERE date>='{$tanggalAwalReport}' and date <='{$tanggalAkhirReport}' and ferry = '{$kapalReport}' and route = '{$lintasanReport}'
        ");

        // sheet peratama
        $sheet->setTitle($title);
        $sheet->mergeCells('C3:H4')->getStyle('C3')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->mergeCells('C3:H4')->getStyle('C3')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $sheet->mergeCells('D5:F5')->getStyle('D5')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
        $sheet->mergeCells('D6:F6')->getStyle('D6')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
        $sheet->mergeCells('C7:C8')->getStyle('C7')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->mergeCells('C7:C8')->getStyle('C7')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $sheet->mergeCells('D7:D8')->getStyle('D7')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->mergeCells('D7:D8')->getStyle('D7')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $sheet->mergeCells('E7:H7')->getStyle('E7')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->mergeCells('C9:C16')->getStyle('C9')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->mergeCells('C9:C16')->getStyle('C9')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $sheet->mergeCells('C17:C30')->getStyle('C17')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->mergeCells('C17:C30')->getStyle('C17')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $sheet->mergeCells('C31:C34')->getStyle('C31')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->mergeCells('C31:C34')->getStyle('C31')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $sheet->mergeCells('C35:C40')->getStyle('C35')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->mergeCells('C35:C40')->getStyle('C35')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $sheet->mergeCells('G44:G46')->getStyle('G44')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->mergeCells('G44:G46')->getStyle('G44')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

        $sheet->setCellValue('C3', $title);
        $sheet->getStyle('C3')->getFont()->setBold(true);
        $sheet->setCellValue('C5', 'Cabang')->getStyle('C5')->getFont()->setBold(true);
        $sheet->setCellValue('D5', 'LUWUK');
        $sheet->setCellValue('C6', 'Lintasan')->getStyle('C6')->getFont()->setBold(true);
        $sheet->setCellValue('D6', $lintasanReport);
        $sheet->setCellValue('G5', 'Tanggal')->getStyle('G5')->getFont()->setBold(true);
        if ($tanggalAwalReport == $tanggalAkhirReport) {
            $sheet->setCellValue('H5', $tanggalAwalReport);
        } else {
            $sheet->setCellValue('H5', $tanggalAwalReport . " s/d " . $tanggalAkhirReport);
        }
        $sheet->setCellValue('G6', 'Kapal')->getStyle('G6')->getFont()->setBold(true);
        $sheet->setCellValue('H6', $kapalReport);
        $sheet->setCellValue('C7', 'No')->getStyle('C7')->getFont()->setBold(true);
        $sheet->setCellValue('D7', 'Nama Produksi')->getStyle('D7')->getFont()->setBold(true);
        $sheet->setCellValue('E7', $lintasanReport)->getStyle('E7')->getFont()->setBold(true);
        $sheet->setCellValue('E8', 'Produksi')->getStyle('E8')->getFont()->setBold(true);
        $sheet->setCellValue('F8', 'Pendapatan')->getStyle('F8')->getFont()->setBold(true);
        $sheet->setCellValue('G8', 'Asuransi')->getStyle('G8')->getFont()->setBold(true);
        $sheet->setCellValue('H8', 'Total')->getStyle('H8')->getFont()->setBold(true);
        $sheet->setCellValue('C9', 'I')->getStyle('C9')->getFont()->setBold(true);
        $sheet->setCellValue('C17', 'II')->getStyle('C17')->getFont()->setBold(true);
        $sheet->setCellValue('C31', 'III')->getStyle('C31')->getFont()->setBold(true);
        $sheet->setCellValue('C35', 'IV')->getStyle('C35')->getFont()->setBold(true);
        $sheet->setCellValue('D9', 'Penumpang')->getStyle('D9')->getFont()->setBold(true);
        $sheet->setCellValue('D10', 'Eksekutif Dewasa');
        $sheet->setCellValue('D11', 'Eksekutif Anak');
        $sheet->setCellValue('D12', 'Bisnis Dewasa');
        $sheet->setCellValue('D13', 'Bisnis Anak');
        $sheet->setCellValue('D14', 'Ekonomi Dewasa');
        $sheet->setCellValue('D15', 'Ekonomi Anak');
        $sheet->setCellValue('D16', 'Sub Jumlah');
        $sheet->setCellValue('D17', 'Kendaraan')->getStyle('D17')->getFont()->setBold(true);
        $sheet->setCellValue('D18', 'Golongan I');
        $sheet->setCellValue('D19', 'Golongan II');
        $sheet->setCellValue('D20', 'Golongan III');
        $sheet->setCellValue('D21', 'Golongan IV - Penumpang');
        $sheet->setCellValue('D22', 'Golongan IV - Barang');
        $sheet->setCellValue('D23', 'Golongan V - Penumpang');
        $sheet->setCellValue('D24', 'Golongan V - Barang');
        $sheet->setCellValue('D25', 'Golongan VI - Penumpang');
        $sheet->setCellValue('D26', 'Golongan VI - Barang');
        $sheet->setCellValue('D27', 'Golongan VII');
        $sheet->setCellValue('D28', 'Golongan VIII');
        $sheet->setCellValue('D29', 'Golongan IX');
        $sheet->setCellValue('D30', 'Sub Jumlah')->getStyle('D30')->getFont()->setBold(true);
        $sheet->setCellValue('D31', 'Barang')->getStyle('D31')->getFont()->setBold(true);
        $sheet->setCellValue('D32', 'Curah (Ton)/M3');
        $sheet->setCellValue('D33', 'Curah (M3)');
        $sheet->setCellValue('D34', 'Sub Jumlah')->getStyle('D34')->getFont()->setBold(true);
        $sheet->setCellValue('D35', 'Suplesi')->getStyle('D35')->getFont()->setBold(true);
        $sheet->setCellValue('D36', 'Ek. Ke Bisnis I DWS');
        $sheet->setCellValue('D37', 'Ek. Ke Bisnis I ANK');
        $sheet->setCellValue('D38', 'Ek. Ke Bisnis II DWS');
        $sheet->setCellValue('D39', 'Ek. Ke Bisnis II ANK');
        $sheet->setCellValue('D40', 'Sub Jumlah')->getStyle('D40')->getFont()->setBold(true);
        $sheet->setCellValue('D41', 'Jumlah')->getStyle('D41')->getFont()->setBold(true);
        $sheet->setCellValue('G43', 'Dibuat Oleh')->getStyle('G43')->getFont()->setBold(true);
        foreach ($supervisor as $row) {
            // $sheet->setCellValue('G44', $row['signature_qr'])->getStyle('G44')->getFont()->setBold(true);
            $sheet->setCellValue('G47', $row['name'])->getStyle('G47')->getFont()->setBold(true);
        }


        for ($col = 'A'; $col !== 'K'; $col++) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }
        $sheet->getStyle('C35')->getAlignment()->setWrapText(true);

        $styleArray = ['borders' => ['allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,],]];
        $sheet->getStyle('C3:H41')->applyFromArray($styleArray);
        $styleArrayOutline = ['borders' => ['outline' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,],]];
        $sheet->getStyle('C42:H48')->applyFromArray($styleArrayOutline);
        $sheet->getPageSetup()->setPrintArea('A1:J42', \PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::SETPRINTRANGE_INSERT);
        // $sheet->setBreak('A1:J42',\PhpOffice\PhpSpreadsheet\Worksheet\Worksheet::BREAK_ROW);

        $rowEntry = 8;
        while ($record = mysqli_fetch_array($entryData)) {
            // Jumlah Produksi
            $sheet->setCellValue('E10', $record['Jumlah DewasaEksekutif']);
            $sheet->setCellValue('E11', $record['Jumlah BayiEksekutif']);
            $sheet->setCellValue('E12', $record['Jumlah DewasaBisnis']);
            $sheet->setCellValue('E13', $record['Jumlah BayiBisnis']);
            $sheet->setCellValue('E14', $record['Jumlah DewasaEkonomi']);
            $sheet->setCellValue('E15', $record['Jumlah BayiEkonomi']);
            $sheet->setCellValue('E16', '=SUM(E10:E15)')->getStyle('E16')->getFont()->setBold(true);

            // // Pendapatan Pelayaran
            $sheet->setCellValue('F10', $record['Dewasa Eksekutif']);
            $sheet->setCellValue('F11', $record['Bayi Eksekutif']);
            $sheet->setCellValue('F12', $record['Dewasa Bisnis']);
            $sheet->setCellValue('F13', $record['Bayi Bisnis']);
            $sheet->setCellValue('F14', $record['Dewasa Ekonomi']);
            $sheet->setCellValue('F15', $record['Bayi Ekonomi']);
            $sheet->setCellValue('F16', '=SUM(F10:F15)')->getStyle('F16')->getFont()->setBold(true);

            // // Pendapatan Asuransi
            $sheet->setCellValue('G10', ($record['DewasaEksekutifTJP'] + $record['DewasaEksekutifIW']) * $record['Jumlah DewasaEksekutif']);
            $sheet->setCellValue('G11', ($record['BayiEksekutifTJP'] + $record['BayiEksekutifIW']) * $record['Jumlah BayiEksekutif']);
            $sheet->setCellValue('G12', ($record['DewasaBisnisTJP'] + $record['DewasaBisnisIW']) * $record['Jumlah DewasaBisnis']);
            $sheet->setCellValue('G13', ($record['BayiBisnisTJP'] + $record['BayiBisnisIW']) * $record['Jumlah BayiBisnis']);
            $sheet->setCellValue('G14', ($record['DewasaEkonomiTJP'] + $record['DewasaEkonomiIW']) * $record['Jumlah DewasaEkonomi']);
            $sheet->setCellValue('G15', ($record['BayiEkonomiTJP'] + $record['BayiEkonomiIW']) * $record['Jumlah BayiEkonomi']);
            $sheet->setCellValue('G16', '=SUM(G10:G15)')->getStyle('G16')->getFont()->setBold(true);

            // Total Penumpang
            $sheet->setCellValue('H10', '=F10 + G10');
            $sheet->setCellValue('H11', '=F11 + G11');
            $sheet->setCellValue('H12', '=F12 + G12');
            $sheet->setCellValue('H13', '=F13 + G13');
            $sheet->setCellValue('H14', '=F14 + G14');
            $sheet->setCellValue('H15', '=F15 + G15');
            $sheet->setCellValue('H16', '=SUM(H10:H15)')->getStyle('H16')->getFont()->setBold(true);

            // Tarif Pelayaran
            $sheet->setCellValue('F18', $record['Golongan 1']);
            $sheet->setCellValue('F19', $record['Golongan 2']);
            $sheet->setCellValue('F20', $record['Golongan 3']);
            $sheet->setCellValue('F21', $record['Golongan 4 Penumpang']);
            $sheet->setCellValue('F22', $record['Golongan 4 Barang']);
            $sheet->setCellValue('F23', $record['Golongan 5 Penumpang']);
            $sheet->setCellValue('F24', $record['Golongan 5 Barang']);
            $sheet->setCellValue('F25', $record['Golongan 6 Penumpang']);
            $sheet->setCellValue('F26', $record['Golongan 6 Barang']);
            $sheet->setCellValue('F27', $record['Golongan 7']);
            $sheet->setCellValue('F28', $record['Golongan 8']);
            $sheet->setCellValue('F29', $record['Golongan 9']);
            $sheet->setCellValue('F30', '=SUM(F18:F29)')->getStyle('F30')->getFont()->setBold(true);

            // // Jumlah Produksi
            $sheet->setCellValue('E18', $record['Jumlah Gol1']);
            $sheet->setCellValue('E19', $record['Jumlah Gol2']);
            $sheet->setCellValue('E20', $record['Jumlah Gol3']);
            $sheet->setCellValue('E21', $record['Jumlah Gol4Pen']);
            $sheet->setCellValue('E22', $record['Jumlah Gol4Bar']);
            $sheet->setCellValue('E23', $record['Jumlah Gol5Pen']);
            $sheet->setCellValue('E24', $record['Jumlah Gol5Bar']);
            $sheet->setCellValue('E25', $record['Jumlah Gol6Pen']);
            $sheet->setCellValue('E26', $record['Jumlah Gol6Bar']);
            $sheet->setCellValue('E27', $record['Jumlah Gol7']);
            $sheet->setCellValue('E28', $record['Jumlah Gol8']);
            $sheet->setCellValue('E29', $record['Jumlah Gol9']);
            $sheet->setCellValue('E30', '=SUM(E18:E29)')->getStyle('E30')->getFont()->setBold(true);

            // Pendapatan Asuransi
            $sheet->setCellValue('G18', $record['Jumlah Gol1'] * ($record['Gol1TJP'] + $record['Gol1IW']));
            $sheet->setCellValue('G19', $record['Jumlah Gol2'] * ($record['Gol2TJP'] + $record['Gol2IW']));
            $sheet->setCellValue('G20', $record['Jumlah Gol3'] * ($record['Gol3TJP'] + $record['Gol3IW']));
            $sheet->setCellValue('G21', $record['Jumlah Gol4Pen'] * ($record['Gol4PenTJP'] + $record['Gol4PenIW']));
            $sheet->setCellValue('G22', $record['Jumlah Gol4Bar'] * ($record['Gol4BarTJP'] + $record['Gol4BarIW']));
            $sheet->setCellValue('G23', $record['Jumlah Gol5Pen'] * ($record['Gol5PenTJP'] + $record['Gol5PenIW']));
            $sheet->setCellValue('G24', $record['Jumlah Gol5Bar'] * ($record['Gol5BarTJP'] + $record['Gol5BarIW']));
            $sheet->setCellValue('G25', $record['Jumlah Gol6Pen'] * ($record['Gol6PenTJP'] + $record['Gol6PenIW']));
            $sheet->setCellValue('G26', $record['Jumlah Gol6Bar'] * ($record['Gol6BarTJP'] + $record['Gol6BarIW']));
            $sheet->setCellValue('G27', $record['Jumlah Gol7'] * ($record['Gol7TJP'] + $record['Gol7IW']));
            $sheet->setCellValue('G28', $record['Jumlah Gol8'] * ($record['Gol8TJP'] + $record['Gol8IW']));
            $sheet->setCellValue('G29', $record['Jumlah Gol9'] * ($record['Gol9TJP'] + $record['Gol9IW']));
            $sheet->setCellValue('G30', '=SUM(G18:G29)')->getStyle('G30')->getFont()->setBold(true);

            // Jumlah
            $sheet->setCellValue('H18', '=F18 + G18');
            $sheet->setCellValue('H19', '=F19 + G19');
            $sheet->setCellValue('H20', '=F20 + G20');
            $sheet->setCellValue('H21', '=F21 + G21');
            $sheet->setCellValue('H22', '=F22 + G22');
            $sheet->setCellValue('H23', '=F23 + G23');
            $sheet->setCellValue('H24', '=F24 + G24');
            $sheet->setCellValue('H25', '=F25 + G25');
            $sheet->setCellValue('H26', '=F26 + G26');
            $sheet->setCellValue('H27', '=F27 + G27');
            $sheet->setCellValue('H28', '=F28 + G28');
            $sheet->setCellValue('H29', '=F29 + G29');
            $sheet->setCellValue('H30', '=SUM(H18:H29)')->getStyle('H30')->getFont()->setBold(true);

            // Barang
            // Jumlah Produksi
            $sheet->setCellValue('E32', $record['Jumlah BarangVolume']);
            $sheet->setCellValue('E34', '=SUM(E32)')->getStyle('E34')->getFont()->setBold(true);

            // Pendapatan Asuransi
            // $sheet->setCellValue('G10', $record["DewasaEksekutifTJP"] * $record['Jumlah BarangVolume']);
            // $sheet->setCellValue('G16', '=SUM(G10:G15)');

            // Pendapatan Pelayaran
            $sheet->setCellValue('F32', $record['Barang Pendapatan']);
            $sheet->setCellValue('F34', '=SUM(F32)')->getStyle('F34')->getFont()->setBold(true);

            // Total Penumpang
            $sheet->setCellValue('H32', '=F32 + G32');
            $sheet->setCellValue('H34', '=SUM(H32)')->getStyle('H34')->getFont()->setBold(true);

            //Suplesi
            //Jumlah Produksi
            $sheet->setCellValue('E36', $record['Jumlah Suplesi1Dewasa']);
            $sheet->setCellValue('E37', $record['Jumlah Suplesi1Anak']);
            $sheet->setCellValue('E38', $record['Jumlah Suplesi2Dewasa']);
            $sheet->setCellValue('E39', $record['Jumlah Suplesi2Anak']);
            $sheet->setCellValue('E40', '=SUM(E36:E39)')->getStyle('E40')->getFont()->setBold(true);

            //Pendapatan Pelayaran
            $sheet->setCellValue('F36', $record['Suplesi1 Dewasa']);
            $sheet->setCellValue('F37', $record['Suplesi1 Anak']);
            $sheet->setCellValue('F38', $record['Suplesi2 Dewasa']);
            $sheet->setCellValue('F39', $record['Suplesi2 Anak']);
            $sheet->setCellValue('F40', '=SUM(F36:F39)')->getStyle('F40')->getFont()->setBold(true);

            // Pendapatan Asuransi
            $sheet->setCellValue('H36', $record['Suplesi1 Dewasa']);
            $sheet->setCellValue('H37', $record['Suplesi1 Anak']);
            $sheet->setCellValue('H38', $record['Suplesi2 Dewasa']);
            $sheet->setCellValue('H39', $record['Suplesi2 Anak']);
            $sheet->setCellValue('H40', '=SUM(H36:H39)')->getStyle('H40')->getFont()->setBold(true);

            //Total Baris
            $sheet->setCellValue('E41', '=E16+E30+E34+E40')->getStyle('E41')->getFont()->setBold(true);
            $sheet->setCellValue('F41', '=F16+F30+F34+F40')->getStyle('F41')->getFont()->setBold(true);
            $sheet->setCellValue('G41', '=G16+G30+G34+G40')->getStyle('G41')->getFont()->setBold(true);
            $sheet->setCellValue('H41', '=H16+H30+H34+H40')->getStyle('H41')->getFont()->setBold(true);
        }

        $styleArray = array(
            'allBorders' => array(
                'outline' => array(
                    'style' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                    'color' => array('argb' => 'FFFF0000'),
                ),
            ),
        );

        $sheet = $sheet->getStyle('A1:J45')->applyFromArray($styleArray);

        //=========================== Sheet 2 =============================
        $entryData2 = mysqli_query($koneksi, "
        SELECT *,dayname(date), 
        sum(entry_data.DewasaEksekutif) AS 'Jumlah DewasaEksekutif', sum(entry_data.BayiEksekutif ) AS 'Jumlah BayiEksekutif', sum(entry_data.DewasaBisnis) AS 'Jumlah DewasaBisnis', sum(entry_data.BayiBisnis) AS 'Jumlah BayiBisnis', sum(entry_data.DewasaEkonomi) AS 'Jumlah DewasaEkonomi', sum(entry_data.BayiEkonomi) AS 'Jumlah BayiEkonomi', sum(entry_data.BarangVolume) AS 'Jumlah BarangVolume', sum(entry_data.BarangPendapatan) AS 'Jumlah BarangPendapatan',
            sum(entry_data.Gol1) as 'Jumlah Gol1', sum(entry_data.Gol2) as 'Jumlah Gol2', sum(entry_data.Gol3) as 'Jumlah Gol3', sum(entry_data.Gol4Pen) as 'Jumlah Gol4Pen', sum(entry_data.Gol4Bar) as 'Jumlah Gol4Bar', sum(entry_data.Gol5Pen) as 'Jumlah Gol5Pen',sum(entry_data.Gol5Bar) as 'Jumlah Gol5Bar',sum(entry_data.Gol6Pen) as 'Jumlah Gol6Pen',sum(entry_data.Gol6Bar) as 'Jumlah Gol6Bar',sum(entry_data.Gol7) as 'Jumlah Gol7',sum(entry_data.Gol8) as 'Jumlah Gol8',sum(entry_data.Gol9) as 'Jumlah Gol9',
            sum(entry_data.Suplesi1Dewasa) as 'Jumlah Suplesi1Dewasa', sum(entry_data.Suplesi2Dewasa) as 'Jumlah Suplesi2Dewasa', sum(entry_data.Suplesi1Anak) as 'Jumlah Suplesi1Anak', sum(entry_data.Suplesi2Anak) as 'Jumlah Suplesi2Anak',

            sum((rate.DewasaEksekutif * entry_data.DewasaEksekutif)) as 'Dewasa Eksekutif',
            sum((rate.BayiEksekutif * entry_data.BayiEksekutif)) as 'Bayi Eksekutif',
            sum((rate.DewasaBisnis * entry_data.DewasaBisnis)) as 'Dewasa Bisnis',
            sum((rate.BayiBisnis * entry_data.BayiBisnis)) as 'Bayi Bisnis',
            sum((rate.DewasaEkonomi * entry_data.DewasaEkonomi)) as 'Dewasa Ekonomi',
            sum((rate.BayiEkonomi * entry_data.BayiEkonomi)) as 'Bayi Ekonomi',
            sum((rate.Gol1 * entry_data.Gol1)) as 'Golongan 1',
            sum((rate.Gol2 * entry_data.Gol2)) as 'Golongan 2',
            sum((rate.Gol3 * entry_data.Gol3)) as 'Golongan 3',
            sum((rate.Gol4Pen * entry_data.Gol4Pen)) as 'Golongan 4 Penumpang',
            sum((rate.Gol4Bar * entry_data.Gol4Bar)) as 'Golongan 4 Barang',
            sum((rate.Gol5Pen * entry_data.Gol5Pen)) as 'Golongan 5 Penumpang',
            sum((rate.Gol5Bar * entry_data.Gol5Bar)) as 'Golongan 5 Barang',
            sum((rate.Gol6Pen * entry_data.Gol6Pen)) as 'Golongan 6 Penumpang',
            sum((rate.Gol6Bar * entry_data.Gol6Bar)) as 'Golongan 6 Barang',
            sum((rate.Gol7 * entry_data.Gol7)) as 'Golongan 7',
            sum((rate.Gol8 * entry_data.Gol8)) as 'Golongan 8',
            sum((rate.Gol9 * entry_data.Gol9)) as 'Golongan 9',
            sum(entry_data.BarangPendapatan) as 'Barang Pendapatan',
            sum(entry_data.BarangVolume) as 'Entry Barang Volume',
            sum((rate.Suplesi1Dewasa * entry_data.Suplesi1Dewasa)) as 'Suplesi1 Dewasa',
            sum((rate.Suplesi1Anak * entry_data.Suplesi1Anak)) as 'Suplesi1 Anak',
            sum((rate.Suplesi2Dewasa * entry_data.Suplesi2Dewasa)) as 'Suplesi2 Dewasa',
            sum((rate.Suplesi2Anak * entry_data.Suplesi2Anak)) as 'Suplesi2 Anak'
        FROM entry_data
        JOIN ferry ON ferry.id = entry_data.id_ferry
        JOIN routes ON routes.id = entry_data.id_route
        JOIN harbours on harbours.id_harbours = entry_data.id_harbour
        JOIN rate ON rate.id_route = routes.id and entry_data.date >= rate.start_date and rate.rate_type = entry_data.rate_type
        WHERE date >='{$tanggalAwalReport}' and date <='{$tanggalAkhirReport}' and ferry = '{$kapalReport}' and route = '{$lintasanReport}'
    ");
        $myWorkSheet = new \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet($spreadsheet, 'Bukti Penyetoran');
        $spreadsheet->addSheet($myWorkSheet, 1);
        $titleSheet2 = 'Bukti Penyetoran';
        // sheet peratama
        $myWorkSheet->setTitle($titleSheet2);
        $myWorkSheet->mergeCells('A1:J1')->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $myWorkSheet->mergeCells('A2:D2')->getStyle('A2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
        $myWorkSheet->mergeCells('A3:D3')->getStyle('A3')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
        $myWorkSheet->mergeCells('A4:D4')->getStyle('A4')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
        $myWorkSheet->mergeCells('A5:D5')->getStyle('A5')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
        $myWorkSheet->mergeCells('A6:D6')->getStyle('A6')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
        $myWorkSheet->mergeCells('E2:J2')->getStyle('E2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
        $myWorkSheet->mergeCells('E3:J3')->getStyle('E3')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
        $myWorkSheet->mergeCells('E4:J4')->getStyle('E4')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
        $myWorkSheet->mergeCells('E5:J5')->getStyle('E5')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
        $myWorkSheet->mergeCells('E6:J6')->getStyle('E6')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
        $myWorkSheet->mergeCells('A7:A8')->getStyle('A7')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $myWorkSheet->mergeCells('B7:B8')->getStyle('B7')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $myWorkSheet->mergeCells('C7:D7')->getStyle('C7')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $myWorkSheet->mergeCells('E7:F7')->getStyle('E7')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $myWorkSheet->mergeCells('G7:G8')->getStyle('G7')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $myWorkSheet->mergeCells('J7:J8')->getStyle('J7')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $myWorkSheet->mergeCells('H7:I7')->getStyle('H7')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $myWorkSheet->mergeCells('B9:J9')->getStyle('B9')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $myWorkSheet->mergeCells('B17:J17')->getStyle('B17')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $myWorkSheet->mergeCells('B31:J31')->getStyle('B31')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $myWorkSheet->mergeCells('C16:F16')->getStyle('B31')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $myWorkSheet->mergeCells('C30:F30')->getStyle('B31')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $myWorkSheet->mergeCells('C33:F33')->getStyle('B31')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $myWorkSheet->mergeCells('C34:F34')->getStyle('B31')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $myWorkSheet->mergeCells('C35:J35')->getStyle('B31')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $myWorkSheet->mergeCells('A9:A16')->getStyle('A9')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $myWorkSheet->mergeCells('A17:A30')->getStyle('A17')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $myWorkSheet->mergeCells('A31:A34')->getStyle('A31')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $myWorkSheet->mergeCells('B38:B40')->getStyle('B38')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $myWorkSheet->mergeCells('E38:E40')->getStyle('E38')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $myWorkSheet->mergeCells('I38:I40')->getStyle('I38')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $myWorkSheet->setCellValue('A1', $titleSheet2);
        $myWorkSheet->setCellValue('A2', 'Hari');
        $myWorkSheet->setCellValue('A3', 'Tanggal');
        $myWorkSheet->setCellValue('A4', 'Pelabuhan');
        $myWorkSheet->setCellValue('A5', 'Lintas');
        $myWorkSheet->setCellValue('A6', 'Jam Pemberangkatan');
        if ($tanggalAwalReport == $tanggalAkhirReport) {
            $myWorkSheet->setCellValue('E2', getHari($tanggalAwalReport));
        } elseif (getBulan($tanggalAwalReport) == getBulan($tanggalAkhirReport)) {
            $myWorkSheet->setCellValue('E2', getBulan($tanggalAwalReport));
        } else {
            $myWorkSheet->setCellValue('E2', "");
        }

        if ($tanggalAwalReport == $tanggalAkhirReport) {
            $myWorkSheet->setCellValue('E3', $tanggalAwalReport);
        } else {
            $myWorkSheet->setCellValue('E3', $tanggalAwalReport . " s/d " . $tanggalAkhirReport);
        }
        $myWorkSheet->setCellValue('E4', $pelabuhanReport);
        $myWorkSheet->setCellValue('E5', $lintasanReport);
        $myWorkSheet->setCellValue('C7', 'Tarif');
        $myWorkSheet->setCellValue('E7', 'Nomor Seri Terjual');
        $myWorkSheet->setCellValue('H7', 'Pendapatan');
        $myWorkSheet->setCellValue('A7', 'No');
        $myWorkSheet->setCellValue('B7', 'Jenis Tiket');
        $myWorkSheet->setCellValue('C8', 'Pelayaran');
        $myWorkSheet->setCellValue('D8', 'Asuransi');
        $myWorkSheet->setCellValue('E8', 'Awal');
        $myWorkSheet->setCellValue('F8', 'Akhir');
        $myWorkSheet->setCellValue('G7', 'Jumlah');
        $myWorkSheet->setCellValue('H8', 'Pelayaran');
        $myWorkSheet->setCellValue('I8', 'Asuransi');
        $myWorkSheet->setCellValue('J7', 'Jumlah');
        $myWorkSheet->setCellValue('A9', 'I');
        $myWorkSheet->setCellValue('B9', 'Tiket Penumpang');
        $myWorkSheet->setCellValue('B10', 'Dewasa Eksekutif')->getStyle('B10')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);;
        $myWorkSheet->setCellValue('B11', 'Anak Eksekutif')->getStyle('B11')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);;
        $myWorkSheet->setCellValue('B12', 'Dewasa Bisnis')->getStyle('B12')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);;
        $myWorkSheet->setCellValue('B13', 'Anak Bisnis')->getStyle('B13')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);;
        $myWorkSheet->setCellValue('B14', 'Dewasa Ekonomi')->getStyle('B14')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);;
        $myWorkSheet->setCellValue('B15', 'Anak Ekonomi')->getStyle('B15')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);;
        $myWorkSheet->setCellValue('B16', 'Jumlah Penumpang');

        $myWorkSheet->setCellValue('A17', 'II');
        $myWorkSheet->setCellValue('B17', 'Tiket Kendaraan');
        $myWorkSheet->setCellValue('B18', 'Golongan I')->getStyle('B18')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);;
        $myWorkSheet->setCellValue('B19', 'Golongan II')->getStyle('B19')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);;
        $myWorkSheet->setCellValue('B20', 'Golongan III')->getStyle('B20')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);;
        $myWorkSheet->setCellValue('B21', 'Golongan IV Penumpang')->getStyle('B21')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);;
        $myWorkSheet->setCellValue('B22', 'Golongan IV Barang')->getStyle('B22')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);;
        $myWorkSheet->setCellValue('B23', 'Golongan V Penumpang')->getStyle('B23')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);;
        $myWorkSheet->setCellValue('B24', 'Golongan V Barang')->getStyle('B24')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);;
        $myWorkSheet->setCellValue('B25', 'Golongan VI Penumpang')->getStyle('B25')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);;
        $myWorkSheet->setCellValue('B26', 'Golongan VI Barang')->getStyle('B26')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);;
        $myWorkSheet->setCellValue('B27', 'Golongan VII')->getStyle('B27')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);;
        $myWorkSheet->setCellValue('B28', 'Golongan VIII')->getStyle('B28')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);;
        $myWorkSheet->setCellValue('B29', 'Golongan IX')->getStyle('B29')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);;
        $myWorkSheet->setCellValue('B30', 'Jumlah Kendaraan');

        $myWorkSheet->setCellValue('A31', 'III');
        $myWorkSheet->setCellValue('B31', 'Barang');
        $myWorkSheet->setCellValue('B32', 'Barang Curah')->getStyle('B32')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);;
        $myWorkSheet->setCellValue('B33', 'Jumlah Barang');
        $myWorkSheet->setCellValue('B34', 'Jumlah');
        $myWorkSheet->setCellValue('B35', 'Terbilang');
        foreach ($this->employee as $row) {
            if ($row['position'] == "MANAGER USAHA") {
                $myWorkSheet->setCellValue('B37', 'MANAGER USAHA');
                $myWorkSheet->setCellValue('B41', $row['name']);
                $myWorkSheet->setCellValue('B42', 'NIK ' . $row['id_num']);
            }
            if ($row['position'] == "KASIR") {
                $myWorkSheet->setCellValue('E37', 'KASIR');
                $myWorkSheet->setCellValue('E41', $row['name']);
                $myWorkSheet->setCellValue('E42', 'NIK ' . $row['id_num']);
            }
        }
        foreach ($supervisor as $row) {
            $myWorkSheet->setCellValue('I37', $row['position']);
            $myWorkSheet->setCellValue('I41', $row['name']);
            $myWorkSheet->setCellValue('I42', 'NIK ' . $row['id_num']);
        }


        for ($col = 'A'; $col !== 'K'; $col++) {
            $myWorkSheet->getColumnDimension($col)->setAutoSize(true);
        }
        $myWorkSheet->getStyle('C35')->getAlignment()->setWrapText(true);
        //Tiket Penumpang
        for ($row = 10; $row !== 16; $row++)
            $myWorkSheet->getRowDimension($row)->setRowHeight(45);

        //Tiket Penumpang
        for ($row = 18; $row !== 30; $row++)
            $myWorkSheet->getRowDimension($row)->setRowHeight(45);

        //Tiket Penumpang
        for ($row = 32; $row !== 33; $row++)
            $myWorkSheet->getRowDimension($row)->setRowHeight(45);


        $styleArray = ['borders' => ['allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,],]];
        $myWorkSheet->getStyle('A1:J35')->applyFromArray($styleArray);
        $styleArrayOutline = ['borders' => ['outline' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,],]];
        $myWorkSheet->getStyle('A36:J45')->applyFromArray($styleArrayOutline);
        $myWorkSheet->getPageSetup()->setPrintArea('A1:J42', \PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::SETPRINTRANGE_INSERT);
        // $myWorkSheet->setBreak('A1:J42',\PhpOffice\PhpSpreadsheet\Worksheet\Worksheet::BREAK_ROW);


        while ($record = mysqli_fetch_array($entryData2)) {

            if (!$record['time']) {
                $myWorkSheet->setCellValue('E6', $jamReport);
            } else {
                $myWorkSheet->setCellValue('E6', $record['time']);
            }

            // Tarif Pelayaran
            $myWorkSheet->setCellValue('C10', $record['DewasaEksekutif']);
            $myWorkSheet->setCellValue('C11', $record['BayiEksekutif']);
            $myWorkSheet->setCellValue('C12', $record['DewasaBisnis']);
            $myWorkSheet->setCellValue('C13', $record['BayiBisnis']);
            $myWorkSheet->setCellValue('C14', $record['DewasaEkonomi']);
            $myWorkSheet->setCellValue('C15', $record['BayiEkonomi']);

            // Tarif Asuransi
            $myWorkSheet->setCellValue('D10', $record['DewasaEksekutifTJP'] + $record['DewasaEksekutifIW']);
            $myWorkSheet->setCellValue('D11', $record['BayiEksekutifTJP'] + $record['BayiEksekutifIW']);
            $myWorkSheet->setCellValue('D12', $record['DewasaBisnisTJP'] + $record['DewasaBisnisIW']);
            $myWorkSheet->setCellValue('D13', $record['BayiBisnisTJP'] + $record['BayiBisnisIW']);
            $myWorkSheet->setCellValue('D14', $record['DewasaEkonomiTJP'] + $record['DewasaEkonomiIW']);
            $myWorkSheet->setCellValue('D15', $record['BayiEkonomiTJP'] + $record['BayiEkonomiIW']);

            // Jumlah
            $myWorkSheet->setCellValue('G10', $record['Jumlah DewasaEksekutif']);
            $myWorkSheet->setCellValue('G11', $record['Jumlah BayiEksekutif']);
            $myWorkSheet->setCellValue('G12', $record['Jumlah DewasaBisnis']);
            $myWorkSheet->setCellValue('G13', $record['Jumlah BayiBisnis']);
            $myWorkSheet->setCellValue('G14', $record['Jumlah DewasaEkonomi']);
            $myWorkSheet->setCellValue('G15', $record['Jumlah BayiEkonomi']);
            $myWorkSheet->setCellValue('G16', '=SUM(G10:G15)');
            // Nomor Seri Awal
            $myWorkSheet->setCellValue('E10', $record['DewasaEksekutifSerial_start'] . "\n" . $record['DewasaEksekutif2Serial_start'] . "\n" . $record['DewasaEksekutif3Serial_start']);
            $myWorkSheet->setCellValue('E11', $record['BayiEksekutifSerial_start'] . "\n" . $record['BayiEksekutif2Serial_start'] . "\n" . $record['BayiEksekutif3Serial_start']);
            $myWorkSheet->setCellValue('E12', $record['DewasaBisnisSerial_start'] . "\n" . $record['DewasaBisnis2Serial_start'] . "\n" . $record['DewasaBisnis3Serial_start']);
            $myWorkSheet->setCellValue('E13', $record['BayiBisnisSerial_start'] . "\n" . $record['BayiBisnis2Serial_start'] . "\n" . $record['BayiBisnis3Serial_start']);
            $myWorkSheet->setCellValue('E14', $record['DewasaEkonomiSerial_start'] . "\n" . $record['DewasaEkonomi2Serial_start'] . "\n" . $record['DewasaEkonomi3Serial_start']);
            $myWorkSheet->setCellValue('E15', $record['BayiEkonomiSerial_start'] . "\n" . $record['BayiEkonomi2Serial_start'] . "\n" . $record['BayiEkonomi3Serial_start']);
            // Nomor Seri Akhir
            $myWorkSheet->setCellValue('F10', $record['DewasaEksekutifSerial_end'] . "\n" . $record['DewasaEksekutif2Serial_end'] . "\n" . $record['DewasaEksekutif3Serial_end']);
            $myWorkSheet->setCellValue('F11', $record['BayiEksekutifSerial_end'] . "\n" . $record['BayiEksekutif2Serial_end'] . "\n" . $record['BayiEksekutif3Serial_end']);
            $myWorkSheet->setCellValue('F12', $record['DewasaBisnisSerial_end'] . "\n" . $record['DewasaBisnis2Serial_end'] . "\n" . $record['DewasaBisnis3Serial_end']);
            $myWorkSheet->setCellValue('F13', $record['BayiBisnisSerial_start'] . "\n" . $record['BayiBisnis2Serial_start'] . "\n" . $record['BayiBisnis3Serial_start']);
            $myWorkSheet->setCellValue('F14', $record['DewasaEkonomiSerial_end'] . "\n" . $record['DewasaEkonomi2Serial_end'] . "\n" . $record['DewasaEkonomi3Serial_end']);
            $myWorkSheet->setCellValue('F15', $record['BayiEkonomiSerial_end'] . "\n" . $record['BayiEkonomi2Serial_end'] . "\n" . $record['BayiEkonomi3Serial_end']);

            // Pendapatan Pelayaran
            $myWorkSheet->setCellValue('H10', $record['Dewasa Eksekutif']);
            $myWorkSheet->setCellValue('H11', $record['Bayi Eksekutif']);
            $myWorkSheet->setCellValue('H12', $record['Dewasa Bisnis']);
            $myWorkSheet->setCellValue('H13', $record['Bayi Bisnis']);
            $myWorkSheet->setCellValue('H14', $record['Dewasa Ekonomi']);
            $myWorkSheet->setCellValue('H15', $record['Bayi Ekonomi']);
            $myWorkSheet->setCellValue('H16', '=SUM(H10:H15)');

            // Pendapatan Asuransi
            $myWorkSheet->setCellValue('I10', '=D10 * G10');
            $myWorkSheet->setCellValue('I11', '=D11 * G11');
            $myWorkSheet->setCellValue('I12', '=D12 * G12');
            $myWorkSheet->setCellValue('I13', '=D13 * G13');
            $myWorkSheet->setCellValue('I14', '=D14 * G14');
            $myWorkSheet->setCellValue('I15', '=D15 * G15');
            $myWorkSheet->setCellValue('I16', '=SUM(I10:I15)');

            // Jumlah
            $myWorkSheet->setCellValue('J10', '=H10 + I10');
            $myWorkSheet->setCellValue('J11', '=H11 + I11');
            $myWorkSheet->setCellValue('J12', '=H12 + I12');
            $myWorkSheet->setCellValue('J13', '=H13 + I13');
            $myWorkSheet->setCellValue('J14', '=H14 + I14');
            $myWorkSheet->setCellValue('J15', '=H15 + I15');
            $myWorkSheet->setCellValue('J16', '=SUM(J10:J15)');

            // Nomor Seri Pelayaran
            $myWorkSheet->setCellValue('C18', $record['Gol1']);
            $myWorkSheet->setCellValue('C19', $record['Gol2']);
            $myWorkSheet->setCellValue('C20', $record['Gol3']);
            $myWorkSheet->setCellValue('C21', $record['Gol4Pen']);
            $myWorkSheet->setCellValue('C22', $record['Gol4Bar']);
            $myWorkSheet->setCellValue('C23', $record['Gol5Pen']);
            $myWorkSheet->setCellValue('C24', $record['Gol5Bar']);
            $myWorkSheet->setCellValue('C25', $record['Gol6Pen']);
            $myWorkSheet->setCellValue('C26', $record['Gol6Bar']);
            $myWorkSheet->setCellValue('C27', $record['Gol7']);
            $myWorkSheet->setCellValue('C28', $record['Gol8']);
            $myWorkSheet->setCellValue('C29', $record['Gol9']);

            // Tarif Asuransi
            $myWorkSheet->setCellValue('D18', $record['Gol1TJP'] + $record['Gol1IW']);
            $myWorkSheet->setCellValue('D19', $record['Gol2TJP'] + $record['Gol2IW']);
            $myWorkSheet->setCellValue('D20', $record['Gol3TJP'] + $record['Gol3IW']);
            $myWorkSheet->setCellValue('D21', $record['Gol4PenTJP'] + $record['Gol4PenIW']);
            $myWorkSheet->setCellValue('D22', $record['Gol4BarTJP'] + $record['Gol4BarIW']);
            $myWorkSheet->setCellValue('D23', $record['Gol5PenTJP'] + $record['Gol5PenIW']);
            $myWorkSheet->setCellValue('D24', $record['Gol5BarTJP'] + $record['Gol5BarIW']);
            $myWorkSheet->setCellValue('D25', $record['Gol6PenTJP'] + $record['Gol6PenIW']);
            $myWorkSheet->setCellValue('D26', $record['Gol6BarTJP'] + $record['Gol6BarIW']);
            $myWorkSheet->setCellValue('D27', $record['Gol7TJP'] + $record['Gol7IW']);
            $myWorkSheet->setCellValue('D28', $record['Gol8TJP'] + $record['Gol8IW']);
            $myWorkSheet->setCellValue('D29', $record['Gol9TJP'] + $record['Gol9IW']);
            // Nomor Seri Awal
            $myWorkSheet->setCellValue('E18', $record['Gol1Serial_start'] . "\n" . $record['Gol12Serial_start'] . "\n" . $record['Gol13Serial_start']);
            $myWorkSheet->setCellValue('E19', $record['Gol2Serial_start'] . "\n" . $record['Gol22Serial_start'] . "\n" . $record['Gol23Serial_start']);
            $myWorkSheet->setCellValue('E20', $record['Gol3Serial_start'] . "\n" . $record['Gol32Serial_start'] . "\n" . $record['Gol33Serial_start']);
            $myWorkSheet->setCellValue('E21', $record['Gol4PenSerial_start'] . "\n" . $record['Gol4Pen2Serial_start'] . "\n" . $record['Gol4Pen3Serial_start']);
            $myWorkSheet->setCellValue('E22', $record['Gol4BarSerial_start'] . "\n" . $record['Gol4Bar2Serial_start'] . "\n" . $record['Gol4Bar3Serial_start']);
            $myWorkSheet->setCellValue('E23', $record['Gol5PenSerial_start'] . "\n" . $record['Gol5Pen2Serial_start'] . "\n" . $record['Gol5Pen3Serial_start']);
            $myWorkSheet->setCellValue('E24', $record['Gol5BarSerial_start'] . "\n" . $record['Gol5Bar2Serial_start'] . "\n" . $record['Gol5Bar3Serial_start']);
            $myWorkSheet->setCellValue('E25', $record['Gol6PenSerial_start'] . "\n" . $record['Gol6Pen2Serial_start'] . "\n" . $record['Gol6Pen3Serial_start']);
            $myWorkSheet->setCellValue('E26', $record['Gol6BarSerial_start'] . "\n" . $record['Gol6Bar2Serial_start'] . "\n" . $record['Gol6Bar3Serial_start']);
            $myWorkSheet->setCellValue('E27', $record['Gol7Serial_start'] . "\n" . $record['Gol72Serial_start'] . "\n" . $record['Gol73Serial_start']);
            $myWorkSheet->setCellValue('E28', $record['Gol8Serial_start'] . "\n" . $record['Gol82Serial_start'] . "\n" . $record['Gol83Serial_start']);
            $myWorkSheet->setCellValue('E29', $record['Gol9Serial_start'] . "\n" . $record['Gol92Serial_start'] . "\n" . $record['Gol93Serial_start']);
            // Nomor Seri Akhir
            $myWorkSheet->setCellValue('F18', $record['Gol1Serial_end'] . "\n" . $record['Gol12Serial_end'] . "\n" . $record['Gol13Serial_end']);
            $myWorkSheet->setCellValue('F19', $record['Gol2Serial_end'] . "\n" . $record['Gol22Serial_end'] . "\n" . $record['Gol23Serial_end']);
            $myWorkSheet->setCellValue('F20', $record['Gol3Serial_end'] . "\n" . $record['Gol32Serial_end'] . "\n" . $record['Gol33Serial_end']);
            $myWorkSheet->setCellValue('F21', $record['Gol4PenSerial_end'] . "\n" . $record['Gol4Pen2Serial_end'] . "\n" . $record['Gol4Pen3Serial_end']);
            $myWorkSheet->setCellValue('F22', $record['Gol4BarSerial_end'] . "\n" . $record['Gol4Bar2Serial_end'] . "\n" . $record['Gol4Bar3Serial_end']);
            $myWorkSheet->setCellValue('F23', $record['Gol5PenSerial_end'] . "\n" . $record['Gol5Pen2Serial_end'] . "\n" . $record['Gol5Pen3Serial_end']);
            $myWorkSheet->setCellValue('F24', $record['Gol5BarSerial_end'] . "\n" . $record['Gol5Bar2Serial_end'] . "\n" . $record['Gol5Bar3Serial_end']);
            $myWorkSheet->setCellValue('F25', $record['Gol6PenSerial_end'] . "\n" . $record['Gol6Pen2Serial_end'] . "\n" . $record['Gol6Pen3Serial_end']);
            $myWorkSheet->setCellValue('F26', $record['Gol6BarSerial_end'] . "\n" . $record['Gol6Bar2Serial_end'] . "\n" . $record['Gol6Bar3Serial_end']);
            $myWorkSheet->setCellValue('F27', $record['Gol7Serial_end'] . "\n" . $record['Gol72Serial_end'] . "\n" . $record['Gol73Serial_end']);
            $myWorkSheet->setCellValue('F28', $record['Gol8Serial_end'] . "\n" . $record['Gol82Serial_end'] . "\n" . $record['Gol83Serial_end']);
            $myWorkSheet->setCellValue('F29', $record['Gol9Serial_end'] . "\n" . $record['Gol92Serial_end'] . "\n" . $record['Gol93Serial_end']);


            // Pendapatan Pelayaran
            $myWorkSheet->setCellValue('H18', '=C18 * G18');
            $myWorkSheet->setCellValue('H19', '=C19 * G19');
            $myWorkSheet->setCellValue('H20', '=C20 * G20');
            $myWorkSheet->setCellValue('H21', '=C21 * G21');
            $myWorkSheet->setCellValue('H22', '=C22 * G22');
            $myWorkSheet->setCellValue('H23', '=C23 * G23');
            $myWorkSheet->setCellValue('H24', '=C24 * G24');
            $myWorkSheet->setCellValue('H25', '=C25 * G25');
            $myWorkSheet->setCellValue('H26', '=C26 * G26');
            $myWorkSheet->setCellValue('H27', '=C27 * G27');
            $myWorkSheet->setCellValue('H28', '=C28 * G28');
            $myWorkSheet->setCellValue('H29', '=C29 * G29');
            $myWorkSheet->setCellValue('H30', '=SUM(H18:H29)');

            // Jumlah
            $myWorkSheet->setCellValue('G18', $record['Jumlah Gol1']);
            $myWorkSheet->setCellValue('G19', $record['Jumlah Gol2']);
            $myWorkSheet->setCellValue('G20', $record['Jumlah Gol3']);
            $myWorkSheet->setCellValue('G21', $record['Jumlah Gol4Pen']);
            $myWorkSheet->setCellValue('G22', $record['Jumlah Gol4Bar']);
            $myWorkSheet->setCellValue('G23', $record['Jumlah Gol5Pen']);
            $myWorkSheet->setCellValue('G24', $record['Jumlah Gol5Bar']);
            $myWorkSheet->setCellValue('G25', $record['Jumlah Gol6Pen']);
            $myWorkSheet->setCellValue('G26', $record['Jumlah Gol6Bar']);
            $myWorkSheet->setCellValue('G27', $record['Jumlah Gol7']);
            $myWorkSheet->setCellValue('G28', $record['Jumlah Gol8']);
            $myWorkSheet->setCellValue('G29', $record['Jumlah Gol9']);
            $myWorkSheet->setCellValue('G30', '=SUM(G18:G29)');

            // Pendapatan Asuransi
            $myWorkSheet->setCellValue('I18', '=D18 * G18');
            $myWorkSheet->setCellValue('I19', '=D19 * G19');
            $myWorkSheet->setCellValue('I20', '=D20 * G20');
            $myWorkSheet->setCellValue('I21', '=D21 * G21');
            $myWorkSheet->setCellValue('I22', '=D22 * G22');
            $myWorkSheet->setCellValue('I23', '=D23 * G23');
            $myWorkSheet->setCellValue('I24', '=D24 * G24');
            $myWorkSheet->setCellValue('I25', '=D25 * G25');
            $myWorkSheet->setCellValue('I26', '=D26 * G26');
            $myWorkSheet->setCellValue('I27', '=D27 * G27');
            $myWorkSheet->setCellValue('I28', '=D28 * G28');
            $myWorkSheet->setCellValue('I29', '=D29 * G29');
            $myWorkSheet->setCellValue('I30', '=SUM(I18:I29)');

            // Jumlah
            $myWorkSheet->setCellValue('J18', '=H18 + I18');
            $myWorkSheet->setCellValue('J19', '=H19 + I19');
            $myWorkSheet->setCellValue('J20', '=H20 + I20');
            $myWorkSheet->setCellValue('J21', '=H21 + I21');
            $myWorkSheet->setCellValue('J22', '=H22 + I22');
            $myWorkSheet->setCellValue('J23', '=H23 + I23');
            $myWorkSheet->setCellValue('J24', '=H24 + I24');
            $myWorkSheet->setCellValue('J25', '=H25 + I25');
            $myWorkSheet->setCellValue('J26', '=H26 + I26');
            $myWorkSheet->setCellValue('J27', '=H27 + I27');
            $myWorkSheet->setCellValue('J28', '=H28 + I28');
            $myWorkSheet->setCellValue('J29', '=H29 + I29');
            $myWorkSheet->setCellValue('J30', '=SUM(J18:J29)');

            //Nomor Seri awal
            $myWorkSheet->setCellValue('E32', $record['BarangPendapatanSerial_start'] . "\n" . $record['BarangPendapatan2Serial_start'] . "\n" . $record['BarangPendapatan3Serial_start']);
            //Nomor Seri Akhir
            $myWorkSheet->setCellValue('F32', $record['BarangPendapatanSerial_end'] . "\n" . $record['BarangPendapatan2Serial_end'] . "\n" . $record['BarangPendapatan3Serial_end']);
            // Jumlah
            $myWorkSheet->setCellValue('G32', $record['Entry Barang Volume']);

            $Curah = 0;
            if ($record['Entry Barang Volume'] != 0)
                $record['BarangPendapatan'] / $record['Entry Barang Volume'];

            //Pendapatan Pelayaran
            $myWorkSheet->setCellValue('H32', $Curah);
            //Asuransi Pendapatan
            $myWorkSheet->setCellValue('I32', 0);
            //Jumlah Pendapatan
            $myWorkSheet->setCellValue('J32', $record['BarangPendapatan']);

            //Jumlah Barang
            $myWorkSheet->setCellValue('G33', '=G32');
            $myWorkSheet->setCellValue('H33', '=H32');
            $myWorkSheet->setCellValue('I33', '=I32');
            $myWorkSheet->setCellValue('J33', '=J32');

            //Jumlah Total
            $myWorkSheet->setCellValue('G34', '=G16 + G30 + G33');
            $myWorkSheet->setCellValue('H34', '=H16 + H30 + H33');
            $myWorkSheet->setCellValue('I34', '=I16 + I30 + I33');
            $myWorkSheet->setCellValue('J34', '=J16 + J30 + J33');

            $myWorkSheet->setCellValue('C35', strtoupper(terbilang($myWorkSheet->getCell('J34')->getCalculatedValue())));
        }


        // $myWorkSheet->getStyle('C10:J16')->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_ACCOUNTING_EUR);
        // $myWorkSheet->getStyle('C18:J30')->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_0);
        // $myWorkSheet->getStyle('C32:J34')->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_0);

        $styleArray = array(
            'allBorders' => array(
                'outline' => array(
                    'style' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                    'color' => array('argb' => 'FFFF0000'),
                ),
            ),
        );


        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename="' . urlencode($title . " " . $lintasanReport . " " . $tanggalAwalReport . " S/D " . $tanggalAkhirReport . ".xlsx") . '"');
        ob_end_clean();
        $writer->save('php://output');
        exit();
    }

    public function rekapAsuransi()
    {
        $data['title'] = 'Rekap Administrasi Asuransi';
        $data['contentView'] = 'report/rekapAsuransi';

        $data['tarif'] = $this->Master_model->rate();
        $data['produksi'] = $this->Entry_model->produksi();
        $data['lintasan'] = $this->Master_model->lintasan();
        $data['pelabuhan'] = $this->Master_model->pelabuhan();
        $data['kapal'] = $this->Master_model->kapal_spv();
        $data['tarif'] = $this->Master_model->tarif();

        $this->load->view('template/dashboard/body', $data);
        // redirect('index');

    }

    public function downloadRekapAsuransi()
    {
        // koneksi php dan mysql
        // $koneksi = mysqli_connect("localhost","root","","asdp_luwuk");
        $koneksi = mysqli_connect("217.21.72.151", "u1578336_admin", "5september_", "u1578336_db_recons_luwuk");

        $title = 'REKAPITULASI ASURANSI BULAN';
        $kapalReport = $this->input->post('nama_kapal');
        $lintasanReport = $this->input->post('lintasan_report');
        $tanggalAwalReport = $this->input->post('tanggal_berangkat');
        $bulanReport = $this->input->post('bulan_report');
        $tahunReport = $this->input->post('tahun_report');
        $tanggalAkhirReport = $this->input->post('tanggal_akhir');
        $supervisor = $this->Report_model->supervisorName();
        $tripReport = $this->input->post('trip');
        $pelabuhanReport = $this->input->post('pelabuhan_asal_report');
        $jamReport = $this->input->post('jam');
        $bulan = [1 => "JANUARI", "FEBURARI", "MARET", "APRIL", "MEI", "JUNI", "JULI", "AGUSTUS", "SEPTEMBER", "OKTOBER", "NOVEMBER", "DESEMBER"];
        $listLintasan = ["GABUNGAN"];
        foreach ($this->Master_model->lintasanSpv() as $row) {
            array_push($listLintasan, $row['lintasan']);
        }
        foreach ($this->Master_model->kapal() as $row) {
            array_push($listLintasan, $row['kapal']);
        }
        $spreadsheet = new Spreadsheet();


        $no = 0;

        foreach ($listLintasan as $lintasan) {
            $sheet = $spreadsheet->setActiveSheetIndex(0);
            $sheet = new \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet($spreadsheet, $lintasan);
            $spreadsheet->addSheet($sheet, $no);
            $titleSheet = $lintasan;

            $batas = '';
            if (str_contains($lintasan, "KMP")) {
                $batas = "AND FERRY = '{$lintasan}'";
            } elseif (str_contains($lintasan, "GABUNGAN")) {
                $batas = "";
            } else {
                $batas = "AND ROUTE = '{$lintasan}'";
            }

            $entryData = mysqli_query(
                $koneksi,
                "
                SELECT *,dayname(date), 
                sum(entry_data.DewasaEksekutif) AS 'Jumlah DewasaEksekutif', sum(entry_data.BayiEksekutif ) AS 'Jumlah BayiEksekutif', sum(entry_data.DewasaBisnis) AS 'Jumlah DewasaBisnis', sum(entry_data.BayiBisnis) AS 'Jumlah BayiBisnis', sum(entry_data.DewasaEkonomi) AS 'Jumlah DewasaEkonomi', sum(entry_data.BayiEkonomi) AS 'Jumlah BayiEkonomi', sum(entry_data.BarangVolume) AS 'Jumlah BarangVolume', sum(entry_data.BarangPendapatan) AS 'Jumlah BarangPendapatan',
                sum(entry_data.Gol1) as 'Jumlah Gol1', sum(entry_data.Gol2) as 'Jumlah Gol2', sum(entry_data.Gol3) as 'Jumlah Gol3', sum(entry_data.Gol4Pen) as 'Jumlah Gol4Pen', sum(entry_data.Gol4Bar) as 'Jumlah Gol4Bar', sum(entry_data.Gol5Pen) as 'Jumlah Gol5Pen',sum(entry_data.Gol5Bar) as 'Jumlah Gol5Bar',sum(entry_data.Gol6Pen) as 'Jumlah Gol6Pen',sum(entry_data.Gol6Bar) as 'Jumlah Gol6Bar',sum(entry_data.Gol7) as 'Jumlah Gol7',sum(entry_data.Gol8) as 'Jumlah Gol8',sum(entry_data.Gol9) as 'Jumlah Gol9',
                sum(entry_data.Suplesi1Dewasa) as 'Jumlah Suplesi1Dewasa', sum(entry_data.Suplesi2Dewasa) as 'Jumlah Suplesi2Dewasa', sum(entry_data.Suplesi1Anak) as 'Jumlah Suplesi1Anak', sum(entry_data.Suplesi2Anak) as 'Jumlah Suplesi2Anak',
                
                entry_data.BarangPendapatan as 'Barang Pendapatan',
                entry_data.BarangVolume as 'Entry Barang Volume',
                sum((rate.Suplesi1Dewasa * entry_data.Suplesi1Dewasa)) as 'Suplesi1 Dewasa',
                sum((rate.Suplesi1Anak * entry_data.Suplesi1Anak)) as 'Suplesi1 Anak',
                sum((rate.Suplesi2Dewasa * entry_data.Suplesi2Dewasa)) as 'Suplesi2 Dewasa',
                sum((rate.Suplesi2Anak * entry_data.Suplesi2Anak)) as 'Suplesi2 Anak'
                FROM entry_data
                JOIN ferry ON ferry.id = entry_data.id_ferry
                JOIN routes ON routes.id = entry_data.id_route
                JOIN harbours on harbours.id_harbours = entry_data.id_harbour
                JOIN rate ON rate.id_route = routes.id and entry_data.date >= rate.start_date and rate.rate_type = entry_data.rate_type
                WHERE month(date) ='{$bulanReport}' AND year(date) = '{$tahunReport}' " . $batas
            );

            // sheet pertama
            $sheet->setTitle($titleSheet);
            $sheet->mergeCells('C3:J4')->getStyle('C3')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->mergeCells('C3:J4')->getStyle('C3')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
            $sheet->mergeCells('D5:F5')->getStyle('D5')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
            $sheet->mergeCells('D6:F6')->getStyle('D6')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
            $sheet->mergeCells('C7:C8')->getStyle('C7')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->mergeCells('C7:C8')->getStyle('C7')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
            $sheet->mergeCells('D7:D8')->getStyle('D7')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->mergeCells('D7:D8')->getStyle('D7')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
            $sheet->mergeCells('E7:E8')->getStyle('E7')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->mergeCells('F7:G7')->getStyle('F7')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->mergeCells('H7:J7')->getStyle('H7')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->mergeCells('H5:J5')->getStyle('H5')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->mergeCells('H6:J6')->getStyle('H6')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->mergeCells('C9:C16')->getStyle('C9')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->mergeCells('C9:C16')->getStyle('C9')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
            $sheet->mergeCells('C17:C30')->getStyle('C17')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->mergeCells('C17:C30')->getStyle('C17')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
            $sheet->mergeCells('C31:C34')->getStyle('C31')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->mergeCells('C31:C34')->getStyle('C31')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
            $sheet->mergeCells('C35:C40')->getStyle('C35')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->mergeCells('C35:C40')->getStyle('C35')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
            $sheet->mergeCells('G43:G44')->getStyle('G43')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
            $sheet->mergeCells('G43:G44')->getStyle('G43')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->mergeCells('J43:J44')->getStyle('J43')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->mergeCells('H46:H47')->getStyle('H46')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
            $sheet->mergeCells('I46:I47')->getStyle('I46')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
            $sheet->mergeCells('J46:J47')->getStyle('J46')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
            $sheet->mergeCells('H50:J50')->getStyle('H50')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->mergeCells('C52:E52')->getStyle('C52')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->mergeCells('F52:G52')->getStyle('F52')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->mergeCells('H52:J52')->getStyle('H52')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->mergeCells('C53:E53')->getStyle('C53')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->mergeCells('F53:G53')->getStyle('F53')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->mergeCells('H53:J53')->getStyle('H53')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->mergeCells('C58:E58')->getStyle('C58')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->mergeCells('F58:G58')->getStyle('F58')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->mergeCells('H58:J58')->getStyle('H58')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->mergeCells('C59:E59')->getStyle('C59')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->mergeCells('F59:G59')->getStyle('F59')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->mergeCells('H59:J59')->getStyle('H59')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

            $sheet->setCellValue('C3', $title . ' PENYETORAN DAN PEMOTONGAN JASA ADMINISTRASI ASURANSI');
            $sheet->getStyle('C3')->getFont()->setBold(true);
            $sheet->setCellValue('C5', 'Cabang')->getStyle('C5')->getFont()->setBold(true);
            $sheet->setCellValue('D5', 'PT. ASDP INDONESIA FERRY (PERSERO) LUWUK');
            $sheet->setCellValue('C6', 'Lintasan')->getStyle('C6')->getFont()->setBold(true);
            $sheet->setCellValue('D6', $lintasan);
            $sheet->setCellValue('G5', 'Bulan')->getStyle('G5')->getFont()->setBold(true);
            $sheet->setCellValue('H5', $bulan[$bulanReport]);
            $sheet->setCellValue('G6', 'Tahun')->getStyle('G6')->getFont()->setBold(true);
            $sheet->setCellValue('H6', $tahunReport);
            $sheet->setCellValue('C7', 'No')->getStyle('C7')->getFont()->setBold(true);
            $sheet->setCellValue('D7', 'Jenis Tiket')->getStyle('D7')->getFont()->setBold(true);
            $sheet->setCellValue('E7', 'Produksi (P)')->getStyle('E7')->getFont()->setBold(true);
            $sheet->setCellValue('F7', 'Premi Asuransi')->getStyle('F7')->getFont()->setBold(true);
            $sheet->setCellValue('F8', 'Jasa Raharja (JR)')->getStyle('F8')->getFont()->setBold(true);
            $sheet->getStyle('F8')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->setCellValue('G8', 'Jasa Raharja Putra (JRP)')->getStyle('G8')->getFont()->setBold(true);
            $sheet->getStyle('G8')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->setCellValue('H7', 'Penyetoran')->getStyle('H7')->getFont()->setBold(true);
            $sheet->setCellValue('H8', 'JR x P')->getStyle('H8')->getFont()->setBold(true);
            $sheet->setCellValue('I8', 'JRP x P')->getStyle('I8')->getFont()->setBold(true);
            $sheet->setCellValue('J8', 'Jumlah')->getStyle('J8')->getFont()->setBold(true);
            $sheet->setCellValue('C9', 'I')->getStyle('C9')->getFont()->setBold(true);
            $sheet->setCellValue('C17', 'II')->getStyle('C17')->getFont()->setBold(true);
            $sheet->setCellValue('C31', 'III')->getStyle('C31')->getFont()->setBold(true);
            $sheet->setCellValue('C35', 'IV')->getStyle('C35')->getFont()->setBold(true);
            $sheet->setCellValue('D9', 'Penumpang')->getStyle('D9')->getFont()->setBold(true);
            $sheet->setCellValue('D10', 'Eksekutif Dewasa');
            $sheet->setCellValue('D11', 'Eksekutif Anak');
            $sheet->setCellValue('D12', 'Bisnis Dewasa');
            $sheet->setCellValue('D13', 'Bisnis Anak');
            $sheet->setCellValue('D14', 'Ekonomi Dewasa');
            $sheet->setCellValue('D15', 'Ekonomi Anak');
            $sheet->setCellValue('D16', 'Sub Jumlah');
            $sheet->setCellValue('D17', 'Kendaraan')->getStyle('D17')->getFont()->setBold(true);
            $sheet->setCellValue('D18', 'Golongan I');
            $sheet->setCellValue('D19', 'Golongan II');
            $sheet->setCellValue('D20', 'Golongan III');
            $sheet->setCellValue('D21', 'Golongan IV - Penumpang');
            $sheet->setCellValue('D22', 'Golongan IV - Barang');
            $sheet->setCellValue('D23', 'Golongan V - Penumpang');
            $sheet->setCellValue('D24', 'Golongan V - Barang');
            $sheet->setCellValue('D25', 'Golongan VI - Penumpang');
            $sheet->setCellValue('D26', 'Golongan VI - Barang');
            $sheet->setCellValue('D27', 'Golongan VII');
            $sheet->setCellValue('D28', 'Golongan VIII');
            $sheet->setCellValue('D29', 'Golongan IX');
            $sheet->setCellValue('D30', 'Sub Jumlah')->getStyle('D30')->getFont()->setBold(true);
            $sheet->setCellValue('D31', 'Barang')->getStyle('D31')->getFont()->setBold(true);
            $sheet->setCellValue('D32', 'Curah (Ton)/M3');
            $sheet->setCellValue('D33', 'Curah (M3)');
            $sheet->setCellValue('D34', 'Sub Jumlah')->getStyle('D34')->getFont()->setBold(true);
            $sheet->setCellValue('D35', 'Suplesi')->getStyle('D35')->getFont()->setBold(true);
            $sheet->setCellValue('D36', 'Ek. Ke Bisnis I DWS');
            $sheet->setCellValue('D37', 'Ek. Ke Bisnis I ANK');
            $sheet->setCellValue('D38', 'Ek. Ke Bisnis II DWS');
            $sheet->setCellValue('D39', 'Ek. Ke Bisnis II ANK');
            $sheet->setCellValue('D40', 'Sub Jumlah')->getStyle('D40')->getFont()->setBold(true);
            $sheet->setCellValue('D41', 'Jumlah')->getStyle('D41')->getFont()->setBold(true);
            $sheet->setCellValue('G43', 'Jasa Administrasi')->getStyle('G43')->getFont()->setBold(true);
            $sheet->setCellValue('H43', '13,75%')->getStyle('H43')->getFont()->setBold(true);
            $sheet->setCellValue('I43', '15,40%')->getStyle('I43')->getFont()->setBold(true);
            $sheet->setCellValue('G46', 'Besaran Penyetoran Asuransi')->getStyle('G46')->getFont()->setBold(true);
            $sheet->getStyle('G46')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->setCellValue('G47', '(Jumlah Total - Jasa Administrasi)')->getStyle('G47')->getFont()->setBold(true);
            $sheet->getStyle('G47')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            if ($bulanReport == 12) {
                $sheet->setCellValue('H50', 'Luwuk, ' . ucwords($bulan[1]) . " " . $tahunReport + 1)->getStyle('G50')->getFont()->setBold(true);
            } else {
                $sheet->setCellValue('H50', 'Luwuk, ' . ucwords($bulan[$bulanReport + 1]) . " " . $tahunReport)->getStyle('G50')->getFont()->setBold(true);
            }
            $sheet->setCellValue('C52', 'Menyetujui,');
            $sheet->setCellValue('C53', 'General Manager');
            $sheet->setCellValue('F52', 'Mengetahui,');
            $sheet->setCellValue('F53', 'Manager Keuangan, SDM & SCM');
            $sheet->setCellValue('H52', 'Membuat,');
            $sheet->setCellValue('H53', 'Staf Keuangan');
            foreach ($this->employee as $row) {
                if ($row['position'] == "GENERAL MANAGER") {
                    $sheet->setCellValue('C58', $row['name']);
                    $sheet->setCellValue('C59', 'NIK ' . $row['id_num']);
                }
                if ($row['position'] == "MANAGER KEUANGAN") {
                    $sheet->setCellValue('F58', $row['name']);
                    $sheet->setCellValue('F59', 'NIK ' . $row['id_num']);
                }
                if ($row['position'] == "STAF KEUANGAN") {
                    $sheet->setCellValue('H58', $row['name']);
                    $sheet->setCellValue('H59', 'NIK ' . $row['id_num']);
                }
            }


            for ($col = 'A'; $col !== 'K'; $col++) {
                $sheet->getColumnDimension($col)->setAutoSize(true);
            }
            $sheet->getStyle('C35')->getAlignment()->setWrapText(true);
            $sheet->getStyle('C3')->getAlignment()->setWrapText(true);

            $styleArray = ['borders' => ['allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,],]];
            $sheet->getStyle('C3:J41')->applyFromArray($styleArray);
            $styleArrayPersentase = ['borders' => ['allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,],]];
            $sheet->getStyle('G43:J44')->applyFromArray($styleArrayPersentase);
            $styleArrayBesaran = ['borders' => ['allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,],]];
            $sheet->getStyle('G46:J47')->applyFromArray($styleArrayBesaran);
            $styleArrayOutline = ['borders' => ['outline' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,],]];
            $sheet->getStyle('C42:J61')->applyFromArray($styleArrayOutline);
            $sheet->getPageSetup()->setPrintArea('A1:J42', \PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::SETPRINTRANGE_INSERT);
            // $sheet->setBreak('A1:J42',\PhpOffice\PhpSpreadsheet\Worksheet\Worksheet::BREAK_ROW);

            while ($record = mysqli_fetch_array($entryData)) {
                // Jumlah Produksi
                $sheet->setCellValue('E10', $record['Jumlah DewasaEksekutif']);
                $sheet->setCellValue('E11', $record['Jumlah BayiEksekutif']);
                $sheet->setCellValue('E12', $record['Jumlah DewasaBisnis']);
                $sheet->setCellValue('E13', $record['Jumlah BayiBisnis']);
                $sheet->setCellValue('E14', $record['Jumlah DewasaEkonomi']);
                $sheet->setCellValue('E15', $record['Jumlah BayiEkonomi']);
                $sheet->setCellValue('E16', '=SUM(E10:E15)')->getStyle('E16')->getFont()->setBold(true);

                // // Pendapatan Pelayaran
                $sheet->setCellValue('F10', $record['DewasaEksekutifIW']);
                $sheet->setCellValue('F11', $record['BayiEksekutifIW']);
                $sheet->setCellValue('F12', $record['DewasaBisnisIW']);
                $sheet->setCellValue('F13', $record['BayiBisnisIW']);
                $sheet->setCellValue('F14', $record['DewasaEkonomiIW']);
                $sheet->setCellValue('F15', $record['BayiEkonomiIW']);
                $sheet->setCellValue('F16', '=SUM(F10:F15)')->getStyle('F16')->getFont()->setBold(true);

                // // Pendapatan Asuransi
                $sheet->setCellValue('G10', $record['DewasaEksekutifTJP']);
                $sheet->setCellValue('G11', $record['BayiEksekutifTJP']);
                $sheet->setCellValue('G12', $record['DewasaBisnisTJP']);
                $sheet->setCellValue('G13', $record['BayiBisnisTJP']);
                $sheet->setCellValue('G14', $record['DewasaEkonomiTJP']);
                $sheet->setCellValue('G15', $record['BayiEkonomiTJP']);
                $sheet->setCellValue('G16', '=SUM(G10:G15)')->getStyle('G16')->getFont()->setBold(true);

                // Total Penumpang
                $sheet->setCellValue('H10', '=F10 * E10');
                $sheet->setCellValue('H11', '=F11 * E11');
                $sheet->setCellValue('H12', '=F12 * E12');
                $sheet->setCellValue('H13', '=F13 * E13');
                $sheet->setCellValue('H14', '=F14 * E14');
                $sheet->setCellValue('H15', '=F15 * E15');
                $sheet->setCellValue('H16', '=SUM(H10:H15)')->getStyle('H16')->getFont()->setBold(true);
                // Total Penumpang
                $sheet->setCellValue('I10', '=G10 * E10');
                $sheet->setCellValue('I11', '=G11 * E11');
                $sheet->setCellValue('I12', '=G12 * E12');
                $sheet->setCellValue('I13', '=G13 * E13');
                $sheet->setCellValue('I14', '=G14 * E14');
                $sheet->setCellValue('I15', '=G15 * E15');
                $sheet->setCellValue('I16', '=SUM(I10:I15)')->getStyle('I16')->getFont()->setBold(true);

                //Total
                $sheet->setCellValue('J10', '=H10 + I10');
                $sheet->setCellValue('J11', '=H11 + I11');
                $sheet->setCellValue('J12', '=H12 + I12');
                $sheet->setCellValue('J13', '=H13 + I13');
                $sheet->setCellValue('J14', '=H14 + I14');
                $sheet->setCellValue('J15', '=H15 + I15');
                $sheet->setCellValue('J16', '=SUM(J10:J15)')->getStyle('J16')->getFont()->setBold(true);
                // // Jumlah Produksi
                $sheet->setCellValue('E18', $record['Jumlah Gol1']);
                $sheet->setCellValue('E19', $record['Jumlah Gol2']);
                $sheet->setCellValue('E20', $record['Jumlah Gol3']);
                $sheet->setCellValue('E21', $record['Jumlah Gol4Pen']);
                $sheet->setCellValue('E22', $record['Jumlah Gol4Bar']);
                $sheet->setCellValue('E23', $record['Jumlah Gol5Pen']);
                $sheet->setCellValue('E24', $record['Jumlah Gol5Bar']);
                $sheet->setCellValue('E25', $record['Jumlah Gol6Pen']);
                $sheet->setCellValue('E26', $record['Jumlah Gol6Bar']);
                $sheet->setCellValue('E27', $record['Jumlah Gol7']);
                $sheet->setCellValue('E28', $record['Jumlah Gol8']);
                $sheet->setCellValue('E29', $record['Jumlah Gol9']);
                $sheet->setCellValue('E30', '=SUM(E18:E29)')->getStyle('E30')->getFont()->setBold(true);

                // Tarif Pelayaran
                $sheet->setCellValue('F18', $record['Gol1IW']);
                $sheet->setCellValue('F19', $record['Gol2IW']);
                $sheet->setCellValue('F20', $record['Gol3IW']);
                $sheet->setCellValue('F21', $record['Gol4PenIW']);
                $sheet->setCellValue('F22', $record['Gol4BarIW']);
                $sheet->setCellValue('F23', $record['Gol5PenIW']);
                $sheet->setCellValue('F24', $record['Gol5BarIW']);
                $sheet->setCellValue('F25', $record['Gol6PenIW']);
                $sheet->setCellValue('F26', $record['Gol6BarIW']);
                $sheet->setCellValue('F27', $record['Gol7IW']);
                $sheet->setCellValue('F28', $record['Gol8IW']);
                $sheet->setCellValue('F29', $record['Gol9IW']);
                $sheet->setCellValue('F30', '=SUM(F18:F29)')->getStyle('F30')->getFont()->setBold(true);



                // Pendapatan Asuransi
                $sheet->setCellValue('G18', $record['Gol1TJP']);
                $sheet->setCellValue('G19', $record['Gol2TJP']);
                $sheet->setCellValue('G20', $record['Gol3TJP']);
                $sheet->setCellValue('G21', $record['Gol4PenTJP']);
                $sheet->setCellValue('G22', $record['Gol4BarTJP']);
                $sheet->setCellValue('G23', $record['Gol5PenTJP']);
                $sheet->setCellValue('G24', $record['Gol5BarTJP']);
                $sheet->setCellValue('G25', $record['Gol6PenTJP']);
                $sheet->setCellValue('G26', $record['Gol6BarTJP']);
                $sheet->setCellValue('G27', $record['Gol7TJP']);
                $sheet->setCellValue('G28', $record['Gol8TJP']);
                $sheet->setCellValue('G29', $record['Gol9TJP']);
                $sheet->setCellValue('G30', '=SUM(G18:G29)')->getStyle('G30')->getFont()->setBold(true);

                // Jumlah
                $sheet->setCellValue('H18', '=F18 * E18');
                $sheet->setCellValue('H19', '=F19 * E19');
                $sheet->setCellValue('H20', '=F20 * E20');
                $sheet->setCellValue('H21', '=F21 * E21');
                $sheet->setCellValue('H22', '=F22 * E22');
                $sheet->setCellValue('H23', '=F23 * E23');
                $sheet->setCellValue('H24', '=F24 * E24');
                $sheet->setCellValue('H25', '=F25 * E25');
                $sheet->setCellValue('H26', '=F26 * E26');
                $sheet->setCellValue('H27', '=F27 * E27');
                $sheet->setCellValue('H28', '=F28 * E28');
                $sheet->setCellValue('H29', '=F29 * E29');
                $sheet->setCellValue('H30', '=SUM(H18:H29)')->getStyle('H30')->getFont()->setBold(true);
                // Jumlah
                $sheet->setCellValue('I18', '=E18 * G18');
                $sheet->setCellValue('I19', '=E19 * G19');
                $sheet->setCellValue('I20', '=E20 * G20');
                $sheet->setCellValue('I21', '=E21 * G21');
                $sheet->setCellValue('I22', '=E22 * G22');
                $sheet->setCellValue('I23', '=E23 * G23');
                $sheet->setCellValue('I24', '=E24 * G24');
                $sheet->setCellValue('I25', '=E25 * G25');
                $sheet->setCellValue('I26', '=E26 * G26');
                $sheet->setCellValue('I27', '=E27 * G27');
                $sheet->setCellValue('I28', '=E28 * G28');
                $sheet->setCellValue('I29', '=E29 * G29');
                $sheet->setCellValue('I30', '=SUM(I18:I29)')->getStyle('I30')->getFont()->setBold(true);

                //Total
                $sheet->setCellValue('J18', '=H18 + I18');
                $sheet->setCellValue('J19', '=H19 + I19');
                $sheet->setCellValue('J20', '=H20 + I20');
                $sheet->setCellValue('J21', '=H21 + I21');
                $sheet->setCellValue('J22', '=H22 + I22');
                $sheet->setCellValue('J23', '=H23 + I23');
                $sheet->setCellValue('J24', '=H24 + I24');
                $sheet->setCellValue('J25', '=H25 + I25');
                $sheet->setCellValue('J26', '=H26 + I26');
                $sheet->setCellValue('J27', '=H27 + I27');
                $sheet->setCellValue('J28', '=H28 + I28');
                $sheet->setCellValue('J29', '=H29 + I29');
                $sheet->setCellValue('J30', '=SUM(J18:J29)')->getStyle('J30')->getFont()->setBold(true);


                // Barang
                // Jumlah Produksi
                $sheet->setCellValue('E32', $record['Jumlah BarangVolume']);
                $sheet->setCellValue('E34', '=SUM(E32)')->getStyle('E34')->getFont()->setBold(true);

                // Pendapatan Asuransi
                // $sheet->setCellValue('G10', $record["DewasaEksekutifTJP"] * $record['Jumlah BarangVolume']);
                // $sheet->setCellValue('G16', '=SUM(G10:G15)');

                // Pendapatan Pelayaran
                $sheet->setCellValue('F32', $record['Barang Pendapatan']);
                $sheet->setCellValue('F34', '=SUM(F32)')->getStyle('F34')->getFont()->setBold(true);

                // Total Penumpang
                $sheet->setCellValue('H32', '=F32 + G32');
                $sheet->setCellValue('H34', '=SUM(H32)')->getStyle('H34')->getFont()->setBold(true);

                //Suplesi
                //Jumlah Produksi
                $sheet->setCellValue('E36', $record['Jumlah Suplesi1Dewasa']);
                $sheet->setCellValue('E37', $record['Jumlah Suplesi1Anak']);
                $sheet->setCellValue('E38', $record['Jumlah Suplesi2Dewasa']);
                $sheet->setCellValue('E39', $record['Jumlah Suplesi2Anak']);
                $sheet->setCellValue('E40', '=SUM(E36:E39)')->getStyle('E40')->getFont()->setBold(true);

                //Pendapatan Pelayaran
                $sheet->setCellValue('F36', $record['Suplesi1 Dewasa']);
                $sheet->setCellValue('F37', $record['Suplesi1 Anak']);
                $sheet->setCellValue('F38', $record['Suplesi2 Dewasa']);
                $sheet->setCellValue('F39', $record['Suplesi2 Anak']);
                $sheet->setCellValue('F40', '=SUM(F36:F39)')->getStyle('F40')->getFont()->setBold(true);

                // Pendapatan Asuransi
                $sheet->setCellValue('H36', $record['Suplesi1 Dewasa']);
                $sheet->setCellValue('H37', $record['Suplesi1 Anak']);
                $sheet->setCellValue('H38', $record['Suplesi2 Dewasa']);
                $sheet->setCellValue('H39', $record['Suplesi2 Anak']);
                $sheet->setCellValue('H40', '=SUM(H36:H39)')->getStyle('H40')->getFont()->setBold(true);



                //Total Baris
                $sheet->setCellValue('E41', '=E16+E30+E34+E40')->getStyle('E41')->getFont()->setBold(true);
                $sheet->setCellValue('F41', '=F16+F30+F34+F40')->getStyle('F41')->getFont()->setBold(true);
                $sheet->setCellValue('G41', '=G16+G30+G34+G40')->getStyle('G41')->getFont()->setBold(true);
                $sheet->setCellValue('H41', '=H16+H30+H34+H40')->getStyle('H41')->getFont()->setBold(true);
                $sheet->setCellValue('I41', '=I16+I30+I34+I40')->getStyle('I41')->getFont()->setBold(true);
                $sheet->setCellValue('J41', '=J16+J30+J34+J40')->getStyle('J41')->getFont()->setBold(true);

                $sheet->setCellValue('H44', '=ROUND((H41*H43),2)')->getStyle('H44')->getFont()->setBold(true);
                $sheet->setCellValue('I44', '=ROUND((I41*I43),2)')->getStyle('I44')->getFont()->setBold(true);
                $sheet->setCellValue('J43', '=H44+I44')->getStyle('J43')->getFont()->setBold(true);

                $sheet->setCellValue('H46', '=+H41 - H44')->getStyle('H46')->getFont()->setBold(true);
                $sheet->setCellValue('I46', '=+I41 - I44')->getStyle('I46')->getFont()->setBold(true);
                $sheet->setCellValue('J46', '=+H46 + I46')->getStyle('J46')->getFont()->setBold(true);
            }

            $styleArray = array(
                'allBorders' => array(
                    'outline' => array(
                        'style' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                        'color' => array('argb' => 'FFFF0000'),
                    ),
                ),
            );

            $sheet = $sheet->getStyle('A1:J45')->applyFromArray($styleArray);
            $sheet->getActiveSheet()->getStyle('A1:K60')->getNumberFormat()->setFormatCode('[Black][>=1000]#,##0;[Red][<0]#.##0;#.##0');

            $no++;
        }

        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename="' . urlencode($title . " " . $bulanReport . " " . $tahunReport . " " . $lintasanReport . ".xlsx") . '"');
        ob_end_clean();
        $writer->save('php://output');
        exit();
    }

    public function sap()
    {
    }
}
